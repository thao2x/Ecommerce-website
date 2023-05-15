<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Api\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images', 'variants')->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ], 200);
    }

    public function show(string $productId)
    {
        $product = Product::with('images', 'variants')->find($productId);

        return response()->json([
            'success' => true,
            'data' => $product
        ], 200);
    }

    public function search(Request $request) {
        $products = Product::with('images', 'variants')->where(function($query) use ($request) {
            if ($request->has('query')) {
                $query->where('name', 'LIKE', '%'.$request['query'].'%');
            }
        })->get();
        
        return response()->json([
            'success' => true,
            'data' => $products
        ], 200);
    }
}
