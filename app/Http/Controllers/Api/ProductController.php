<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['variants', 'media'])->get();
        return response()->json($products);
    }

    public function show(Product $product)
    {
        $product->load(['variants', 'media']);
        return response()->json($product);
    }
}