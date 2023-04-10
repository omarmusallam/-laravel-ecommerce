<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view-any', Product::class);
        $request = request();
        $products = Product::with(['category', 'store'])
            ->filter2($request->query())
            ->orderby('products.created_at', 'desc')
            ->paginate();

        return view('dashboard.products.index', compact('products'));
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

        return view('dashboard.products.create', compact('product', 'tags'));
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
            'name' => ['required', 'string', 'min:3', 'max:20'],
            'store_id' => ['required', 'int', 'exists:stores,id'],
            'category_id' => ['nullable', 'int', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'int'],
            'compare_price' => ['nullable', 'int'],
            'image' => ['image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],
            'status' => 'in:active,draft,archvied',
            // 'tags' => 'string',
        ]);
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);
        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);
        $product = Product::create($data);

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

        $tags = implode(',', $product->tags()->pluck('name')->toArray()); // Convert to string 

        return view('dashboard.products.edit', compact('product', 'tags'));
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
            'name' => ['required', 'string', 'min:3', 'max:20'],
            'store_id' => ['required', 'int', 'exists:stores,id'],
            'category_id' => ['nullable', 'int', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'int'],
            'compare_price' => ['nullable', 'int'],
            'image' => ['image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],
            'status' => 'in:active,draft,archvied',
            // 'tags' => 'string',
        ]);

        // $product = Product::findOrFail($product);

        $old_image = $request->image;

        $data = $request->except('image');

        $new_image = $this->uploadImage($request);
        if ($new_image) {
            $data['image'] = $new_image;
        }
        $product->update($data);

        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }

        // $product->update($request->except('tags'));
        
        // $tags = json_decode($request->post('tags'));
        // $tag_ids = [];

        // $saved_tags = Tag::all();

        // foreach ($tags as $item) {
        //     $slug = Str::slug($item->value);
        //     $tag = $saved_tags->where('slug', $slug)->first();
        //     if (!$tag) {
        //         $tag = Tag::create([
        //             'name' => $item->value,
        //             'slug' => $slug,
        //         ]);
        //     }
        //     $tag_ids[] = $tag->id;
        // }

        // $product->tags()->sync($tag_ids);

        
        return redirect()->route('dashboard.products.index')
            ->with('success', 'Product updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('delete', $product);
        $product->delete();

        return redirect()->route('dashboard.products.index')
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

}