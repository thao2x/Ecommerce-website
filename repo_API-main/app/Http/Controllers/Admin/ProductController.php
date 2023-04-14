<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Variant;

class ProductController extends Controller
{
    public function index(Request $request) {
        $products = Product::where(function($query) use ($request) {
            if ($request->has('query')) {
                $query->where('name', 'LIKE', '%'.$request['query'].'%');
            }
        })->orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.product.index', [
            'products' => $products,
            'query_prev' =>  $request['query']
        ]);
    }

    public function create() {
        $categories = Category::all();

        $product = Product::create([
            'user_id' => Auth::user()->id,
            'type' => 1
        ]);

        return view('admin.product.create', [
            'product' => $product,
            'categories' => $categories,
            'variants' => $product->variants
        ]);
    }

    public function store(Request $request) {
        $data = $request->all();

        $product = Product::findOrFail($data['id']);
        $product->update($data);

        $categories = Category::all();
        
        return view('admin.product.detail', [
            'product' => $product,
            'categories' => $categories,
            'variants' => $product->variants
        ]);
    }

    public function destroy($id) {
        Product::findOrFail($id)->update(['del_flg' => 1]);
        Variant::where('product_id', $id)->update(['del_flg' => 1]);

        return redirect()->route('products.index');
    }

    public function show($id) {
        $product = Product::findOrFail($id);

        return response()->json($product, 200);
    }

    public function detail($id) {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.product.detail', [
            'product' => $product,
            'categories' => $categories,
            'variants' => $product->variants
        ]);
    }
}
