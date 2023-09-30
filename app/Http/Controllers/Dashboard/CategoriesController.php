<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function deleteImage(Request $request, Category $category)
    {
        if ($category->image) {
            $filePath = $category->image;

            $category->update(['image' => null]);

            Storage::disk('public')->delete($filePath);

            return response()->json(['message' => 'Image deleted successfully.']);
        }

        return response()->json(['message' => 'Image not found.'], 404);
    }


    public function index()
    {
        if (!Gate::allows('categories.view')) {
            abort(403);
        }
        $request = request();

        $categories = Category::with('parent')
            ->withCount('products')
            ->filter($request->query())
            ->orderby('categories.created_at')
            ->paginate(); // return collection object

        return view('dashboard.categories.index', compact('categories'));
    }

    public function ajax_search(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->search;
            $status = $request->status;

            $query = Category::query();

            if ($search !== 'restore' && !empty($search)) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            }

            if (!empty($status)) {
                $query->where('status', $status);
            }

            $categories = $query->orderBy('id', 'asc')->get();

            return view('dashboard.categories.ajax', compact('categories', 'search', 'status'));
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('categories.view')) {
            abort(403);
        }
        $parents = Category::all(); // return collection object
        $category = new Category();
        return view('dashboard.categories.create', compact('parents', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('categories.create');

        $request->validate(Category::rouls(), [
            'unique' => 'This is :attribute already exists!'
        ]);

        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        $data = $request->except('image');

        $data['image'] = $this->uploadImage($request);

        $category = Category::create($data);

        if ($request->ajax()) {
            return response()->json($category);
        };

        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Created Done!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if (Gate::denies('categories.view')) {
            abort(403);
        }
        return view('dashboard.categories.show', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        Gate::authorize('categories.update');

        try {
            $category = Category::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('dashboard.categories.index')
                ->with('info', 'Record not found!');
        }

        $parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $id);
            })
            ->get();

        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        // $request->validate(Category::rouls($id));

        $category = Category::findOrFail($id);

        $old_image = $request->image;

        $data = $request->except('image');

        $new_image = $this->uploadImage($request);

        if ($new_image) {
            $data['image'] = $new_image;
        }
        $category->update($data);

        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Updated Done!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Gate::authorize('categories.delete');

        $category = Category::findOrFail($id);
        $category->delete();

        // if ($category->image) {
        //     Storage::disk('public')->delete($category->image);
        // }
        // Category::destroy($id);

        // return response()->json(['message' => 'Deleted Done!']);
        if ($request->ajax()) {
            return response()->json($category);
        };
        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Deleted Done!');
    }

    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image'); // UploadedFile Object

        $path = $file->store('uploads', [
            'disk' => 'public'
        ]);
        return $path;
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash', compact('categories'));
    }

    public function restore(Request $request, $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        if ($request->ajax()) {
            return response()->json($category);
        };

        return redirect()->route('dashboard.categories.trash')
            ->with('success', 'Category restored!');
    }

    public function forceDelete(Request $request, $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        if ($request->ajax()) {
            return response()->json($category);
        };

        return redirect()->route('dashboard.categories.trash')
            ->with('success', 'Category deleted!');
    }
}
