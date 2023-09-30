<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class ProductsController extends Controller
{

    public function deleteGalleryImage(Request $request, Product $product)
    {
        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        if ($request->has('image_id')) {
            $imageId = $request->input('image_id');
            $imageToDelete = $product->images()->find($imageId);

            if ($imageToDelete) {
                $filePath = $imageToDelete->image;

                $imageToDelete->delete();

                Storage::disk('public')->delete($filePath);

                return response()->json(['message' => 'Image deleted successfully.']);
            }
        }

        return response()->json(['message' => 'Image not found.'], 404);
    }

    public function query(Request $request)
    {
        return Product::with(['category', 'store'])
            ->orderby('products.created_at', 'desc')
            ->when($request->name, function ($query, $value) {
                $query->where('name', 'LIKE', "%{$value}%");
            })
            ->when($request->category_id, function ($query, $value) {
                $query->where('category_id', '=', $value);
            });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Product::class);
        $request = request();
        $products = $this->query($request)->paginate();
        $categories = Category::all();
        return view('dashboard.products.index', compact('products', 'categories'));
    }

    public function ajax_search(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->search;
            $status = $request->status;

            $query = Product::query();

            if ($search !== 'restore' && !empty($search)) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            }

            if (!empty($status)) {
                $query->where('category_id', $status);
            }

            $products = $query->orderby('id', 'asc')->get();

            return view('dashboard.products.ajax', compact('products', 'search', 'status'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Product::class);
        $product = new Product();
        $tags = new Tag();
        $admin = Auth::user();

        return view('dashboard.products.create', compact('product', 'tags', 'admin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Product::class);

        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100', 'unique:products,name'],
            'store_id' => ['required', 'int', 'exists:stores,id'],
            'category_id' => ['nullable', 'int', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric'],
            'compare_price' => ['nullable', 'numeric'],
            'image' => ['image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],
            'status' => 'in:active,draft,archvied',
            'tags' => 'string',
        ]);

        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);
        $product = Product::create($data);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $image = $file->store('uploads', [
                    'disk' => 'public'
                ]);
                $product->images()->create([
                    'image' => $image,
                ]);
            }
        }

        // Handle tags
        $tags = json_decode($request->input('tags'));
        $tagIds = [];

        foreach ($tags as $item) {
            $slug = Str::slug($item->value);
            $tag = Tag::firstOrCreate([
                'name' => $item->value,
                'slug' => $slug,
            ]);

            $tagIds[] = $tag->id;
        }

        $product->tags()->sync($tagIds);
        if ($request->ajax()) {
            return response()->json($product);
        };

        return redirect()->route('dashboard.products.index')
            ->with('success', 'Product created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('view', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('update', $product);

        $admin = Auth::user();

        $tags = implode(',', $product->tags()->pluck('name')->toArray()); // Convert to string 

        return view('dashboard.products.edit', compact('product', 'tags', 'admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'store_id' => ['required', 'int', 'exists:stores,id'],
            'category_id' => ['nullable', 'int', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric'],
            'compare_price' => ['nullable', 'numeric'],
            'image' => ['image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],
            'status' => 'in:active,draft,archvied',
            'tags' => 'string',
        ]);

        // $product = Product::findOrFail($product);

        $old_image = $request->image;

        $data = $request->except('image');

        $new_image = $this->uploadImage($request);
        if ($new_image) {
            $data['image'] = $new_image;
        }
        $product->update($data);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $image = $file->store('uploads', [
                    'disk' => 'public'
                ]);
                $product->images()->create([
                    'image' => $image,
                ]);
            }
        }
        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }

        $product->update($request->except('tags'));

        $tags = json_decode($request->post('tags'));
        $tag_ids = [];

        $saved_tags = Tag::all();

        foreach ($tags as $item) {
            $slug = Str::slug($item->value);
            $tag = $saved_tags->where('slug', $slug)->first();
            if (!$tag) {
                $tag = Tag::create([
                    'name' => $item->value,
                    'slug' => $slug,
                ]);
            }
            $tag_ids[] = $tag->id;
        }

        $product->tags()->sync($tag_ids);


        return redirect()->route('dashboard.products.index')
            ->with('success', 'Product updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('delete', $product);
        $product->delete();

        if ($request->ajax()) {
            return response()->json($product);
        };

        return redirect()->route('dashboard.products.index')
            ->with('success', 'Deleted Done!');
    }

    public function export(Request $request)
    {
        $query = $this->query($request);

        $export = new ProductsExport();
        $export->setQuery($query);
        return Excel::download($export, 'products.xlsx');
    }

    public function importView()
    {
        return view('dashboard.products.importView');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => ['required', 'mimes:xls,xlsx,csv'],
        ]);

        Excel::import(new ProductsImport, $request->file('file')->path());

        return redirect()->route('dashboard.products.index')
            ->with('success', 'Product Imported successfully!');
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
}
