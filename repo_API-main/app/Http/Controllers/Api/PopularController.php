<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class PopularController extends Controller
{
    public function index()
    {
        $data = Product::with('images', 'variants')->where('rating', '5')->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function show(string $categoryId)
    {
        $data = Product::with('images', 'variants')->where('category_id', $categoryId)->where('rating', '5')->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }
}
