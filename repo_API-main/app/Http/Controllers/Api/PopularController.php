<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class PopularController extends Controller
{
    public function index()
    {
        $populars = Product::with('images', 'variants')->where('rating', '5')->where('type', 1)->where('del_flg', 0)->get();
        return response()->json([
            'success' => true,
            'data' => $populars
        ], 200);
    }

    public function show(string $categoryId)
    {
        $popular = Product::with('images', 'variants')->where('category_id', $categoryId)->where('rating', '5')->where('type', 1)->where('del_flg', 0)->get();

        return response()->json([
            'success' => true,
            'data' => $popular
        ], 200);
    }
}
