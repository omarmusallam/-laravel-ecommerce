<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ListProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = request();
        $products = Product::inRandomOrder()->with('category')->active()
            ->latest()
            ->filter2($request->query())
            ->paginate(15);

        if ($request->category) {
            $products = Category::where('slug', $request->category)->firstOrFail()->products()->paginate(15);
        }

        $categories = Category::withCount('products')->get();

        return view('front.list-product', compact('products', 'categories'));
    }
    public function ajax_search(Request $request)
    {
        $name = $request->input('name');

        $productsQuery = Product::query()->with('category')->active();

        if ($name) {
            $productsQuery->where('name', 'LIKE', "%$name%");
        }

        $productsQuery->filter2($request->query());

        $products = $productsQuery->paginate(15);

        return view('front.search-product-ajax', compact('products'));
    }
}
