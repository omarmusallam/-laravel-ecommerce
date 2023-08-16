<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Store;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('stores.view');
        $request = request();

        $stores = Store::with(['products'])
            ->withCount('products')
            ->filter($request->query())
            ->orderby('stores.created_at', 'desc')
            ->paginate();

        return view('dashboard.stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('stores.create')) {
            abort(403);
        }
        // $parents = Store::all(); // return collection object
        $store = new Store();
        return view('dashboard.stores.create', compact('store'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('stores.create');

        $request->validate(Store::rouls());

        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        $data = $request->except('image');

        $data['image'] = $this->uploadImage($request);

        $store = Store::create($data);

        return redirect()->route('dashboard.stores.index')
            ->with('success', 'Created Done!');
    }


    public function edit($id)
    {
        Gate::authorize('stores.update');

        try {
            $store = Store::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('dashboard.store.index')
                ->with('info', 'Record not found!');
        }

        return view('dashboard.stores.edit', compact('store'));
    }

    public function show(Store $store)
    {
        if (Gate::denies('stores.view')) {
            abort(403);
        }
        return view('dashboard.stores.show', [
            'store' => $store
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        Gate::authorize('stores.update');
        $category = Store::findOrFail($id);
        $old_image = $request->logo_image;

        $data = $request->except('logo_image');

        $new_image = $this->uploadImage($request);

        if ($new_image) {
            $data['logo_image'] = $new_image;
        }
        $category->update($data);

        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('dashboard.stores.index')
            ->with('success', 'Updated Done!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('stores.delete');

        $store = Store::findOrFail($id);
        $store->delete();

        return redirect()->route('dashboard.stores.index')
            ->with('success', 'Deleted Done!');
    }

    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('logo_image')) {
            return;
        }
        $file = $request->file('logo_image'); // UploadedFile Object

        $path = $file->store('uploads', [
            'disk' => 'public'
        ]);
        return $path;
    }
}