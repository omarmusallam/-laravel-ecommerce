<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::inRandomOrder()->with('category')->active()
            ->latest()
            ->limit(8)
            ->get();

        $products2 = Product::with('category')->active()
            ->latest()
            ->limit(3)
            ->get();

        $product3 = Product::findOrFail(495);
        $product4 = Product::findOrFail(494);
        $product5 = Product::findOrFail(501);

        $product6 = Product::findOrFail(538);
        $product7 = Product::findOrFail(518);
        $product8 = Product::findOrFail(480);

        return view('front.home', compact('products', 'products2', 'product3', 'product4', 'product5', 'product6', 'product7', 'product8'));
    }
}