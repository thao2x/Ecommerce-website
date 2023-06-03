<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('del_flg', 0)->get();

        return response()->json([
            'status' => true,
            'data' => $categories
        ], 200);
    }

    public function search(string $categoryId)
    {
        $products = Product::with('images', 'variants', 'category')->where('category_id', $categoryId)->where('type', 1)->where('del_flg', 0)->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ], 200);
    }
}
