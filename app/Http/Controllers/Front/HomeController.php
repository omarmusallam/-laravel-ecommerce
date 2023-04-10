<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->active()
            ->latest()
            ->limit(8)
            ->get();

        $products2 = Product::with('category')->active()
            ->latest()
            ->limit(3)
            ->get();

        $product3 = Product::findOrFail(450);

        // $product4 = Product::findOrFail(453);

        return view('front.home', compact('products', 'products2', 'product3'));
    }
}