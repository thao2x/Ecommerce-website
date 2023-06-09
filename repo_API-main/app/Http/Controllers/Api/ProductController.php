<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images', 'variants')->where('type', 1)->where('del_flg', 0)->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ], 200);
    }

    public function show(string $productId)
    {
        $product = Product::with(['images', 'variants' => fn($query) => $query->where('del_flg', 0)])->where('type', 1)->where('del_flg', 0)->find($productId);
        return response()->json([
            'success' => true,
            'data' => $product
        ], 200);
    }

    public function search(Request $request)
    {
        $products = Product::with(['images', 'variants' => fn($query) => $query->where('del_flg', 0)])->where('type', 1)->where('del_flg', 0)->where(function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request['query'] . '%');
        })->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ], 200);
    }
}
