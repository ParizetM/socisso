<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_available', true)->get();
        return view('welcome', compact('products'));
    }
}
