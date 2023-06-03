<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use App\Models\Category;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Image;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product');
    }

    public function data()
    {
        $products = Product::with('images', 'category')->where('del_flg', 0)->get();
        return Datatables::of($products)->make();
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product-create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Add Product
        $product = Product::create([
            'category_id' => $request['category_id'],
            'user_id' => $user['id'],
            'name' => $request['name'],
            'type' => $request['type'],
            'price' => $request['price'],
            'description' => $request['description']
        ]);

        // Add Variants
        if ($request->has('size')) {
            foreach (explode(",", $request['size']) as $size) {
                Variant::create([
                    'product_id' => $product['id'],
                    'size' => $size,
                ]);
            }
        }

        // Add Product Image
        if ($request->hasFile('image_a')) {
            $file = $request->file('image_a');
            $name = time() . $file->getClientOriginalName();
            $directory = '/images/products/' . $request['name'] . '/' . $name;
            Storage::disk('public')->put($directory, file_get_contents($file));
            Image::create([
                'product_id' => $product['id'],
                'src' => $directory
            ]);
        }
        if ($request->hasFile('image_b')) {
            $file = $request->file('image_b');
            $name = time() . $file->getClientOriginalName();
            $directory = '/images/products/' . $request['name'] . '/' . $name;
            Storage::disk('public')->put($directory, file_get_contents($file));
            Image::create([
                'product_id' => $product['id'],
                'src' => $directory
            ]);
        }

        if ($request->hasFile('image_c')) {
            $file = $request->file('image_c');
            $name = time() . $file->getClientOriginalName();
            $directory = '/images/products/' . $request['name'] . '/' . $name;
            Storage::disk('public')->put($directory, file_get_contents($file));
            Image::create([
                'product_id' => $product['id'],
                'src' => $directory
            ]);
        }

        if ($request->hasFile('image_d')) {
            $file = $request->file('image_d');
            $name = time() . $file->getClientOriginalName();
            $directory = '/images/products/' . $request['name'] . '/' . $name;
            Storage::disk('public')->put($directory, file_get_contents($file));
            Image::create([
                'product_id' => $product['id'],
                'src' => $directory
            ]);
        }

        return redirect()->route('admin.product.index');
    }

    public function show(string $productId)
    {
        $product = Product::findOrFail($productId);
        $categories = Category::all();

        return view('admin.product-detail', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, string $id)
    {
        // Add Product
        $product = Product::find($id);
        $product->update([
            'category_id' => $request['category_id'],
            'name' => $request['name'],
            'type' => $request['type'],
            'price' => $request['price'],
            'description' => $request['description']
        ]);

        // Delete Prev Variants
        Variant::where('product_id', $product['id'])->update(['del_flg' => 1]);

        // Add Variants
        if ($request->has('size')) {
            foreach (explode(",", $request['size']) as $size) {
                Variant::create([
                    'product_id' => $product['id'],
                    'size' => $size,
                ]);
            }
        }

        // Add Product Image
        if ($request->hasFile('image_a')) {
            $file = $request->file('image_a');
            $name = time() . $file->getClientOriginalName();
            $directory = '/images/products/' . $request['name'] . '/' . $name;
            Storage::disk('public')->put($directory, file_get_contents($file));
            Image::create([
                'product_id' => $product['id'],
                'src' => $directory
            ]);
        }
        if ($request->hasFile('image_b')) {
            $file = $request->file('image_b');
            $name = time() . $file->getClientOriginalName();
            $directory = '/images/products/' . $request['name'] . '/' . $name;
            Storage::disk('public')->put($directory, file_get_contents($file));
            Image::create([
                'product_id' => $product['id'],
                'src' => $directory
            ]);
        }

        if ($request->hasFile('image_c')) {
            $file = $request->file('image_c');
            $name = time() . $file->getClientOriginalName();
            $directory = '/images/products/' . $request['name'] . '/' . $name;
            Storage::disk('public')->put($directory, file_get_contents($file));
            Image::create([
                'product_id' => $product['id'],
                'src' => $directory
            ]);
        }

        if ($request->hasFile('image_d')) {
            $file = $request->file('image_d');
            $name = time() . $file->getClientOriginalName();
            $directory = '/images/products/' . $request['name'] . '/' . $name;
            Storage::disk('public')->put($directory, file_get_contents($file));
            Image::create([
                'product_id' => $product['id'],
                'src' => $directory
            ]);
        }

        // Remove Images Prev
        // dd(!empty($request->input('removeImageIds')));
        if (!empty($request->input('removeImageIds'))) {
            foreach (explode(",", $request['removeImageIds']) as $id) {
                Image::find($id)->delete();
            }
        }

        return redirect()->route('admin.product.index');
    }

    public function destroy(string $productId)
    {
        Product::findOrFail($productId)->update(['del_flg' => 1]);
        Variant::where('product_id', $productId)->update(['del_flg' => 1]);

        return redirect()->route('admin.product.index');
    }
}
