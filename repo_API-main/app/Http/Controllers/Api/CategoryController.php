<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        
        return response()->json([
            'success' => true,
            'data' => $categories
        ], 200);
    }

    public function search(string $categoryId) {
        $products = Product::with('images', 'variants', 'categories')->where('category_id', $categoryId)->get();
        
        return response()->json([
            'success' => true,
            'data' => $products
        ], 200);
    }
}
