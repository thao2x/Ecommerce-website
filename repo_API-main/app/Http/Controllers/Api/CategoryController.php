<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return [type]
     *
     */
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'status' => true,
            'message' => "List of product categories",
            'data' => $categories
        ], Response::HTTP_OK);
    }

    /**
     * Search products by product category
     *
     * @param Category $category
     *
     * @return [type]
     *
     */
    public function search(Category $category)
    {
        $products = Product::with('images', 'variants', 'categories')->where('category_id', $category->id)->get();

        return response()->json([
            'success' => true,
            'message' => "List of products by product category",
            'data' => $products
        ], Response::HTTP_OK);
    }
}
