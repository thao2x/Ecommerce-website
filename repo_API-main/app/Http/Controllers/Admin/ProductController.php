<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Product;
use App\Models\Variant;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::where(function ($query) use ($request) {
            if ($request->has('query')) {
                $query->where('name', 'LIKE', '%' . $request['query'] . '%');
            }
        })->orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.product', [
            'products' => $products,
            'query_prev' => $request['query']
        ]);
    }

    public function store()
    {
        $product = Product::create([
            'user_id' => Auth::user()->id,
            'type' => 1
        ]);

        return redirect()->route('admin.product.show', $product->id);
    }

    public function show(string $productId)
    {
        $product = Product::findOrFail($productId);
        $categories = Category::all();

        return view('admin.product-detail', [
            'product' => $product,
            'categories' => $categories,
            'variants' => $product->variants
        ]);
    }

    public function update(Request $request, string $productId)
    {
        $messages = [
            'name.required' => 'Tên là bắt buộc.',
            'price.required' => 'Giá sản phẩm là bắt buộc.'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Product::findOrFail($productId)->update($request->all());

        return redirect()->route('admin.product.show', $productId);
    }

    public function destroy(string $productId)
    {
        Product::findOrFail($productId)->update(['del_flg' => 1]);
        Variant::where('product_id', $productId)->update(['del_flg' => 1]);

        return redirect()->route('admin.product.index');
    }
}
