<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->orderBy('created_at', 'DESC')->get();

        return view('admin.category', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->messages()
            ], 200);
        }

        $directory = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . $file->getClientOriginalName();
            $directory = 'categories/' . $name;
            Storage::disk('minio')->put($directory, file_get_contents($file));
        }

        Category::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'image' => $directory
        ]);

        $categories = Category::with('products')->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'success' => true,
            'data' => $categories
        ], 200);
    }

    public function show(string $categoryId)
    {
        $category = Category::with('products')->findOrFail($categoryId);

        return response()->json([
            'success' => true,
            'data' => $category
        ], 200);
    }

    public function update(Request $request, string $categoryId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->messages()
            ], 200);
        }        

        $category = Category::findOrFail($categoryId);
        $directory = $category->image;

        // Trường hợp có chỉnh sửa hình ảnh
        if ($request->hasFile('image')) {

            // Lưu hình mới vào minio storage
            $file = $request->file('image');
            $name = time() . $file->getClientOriginalName();
            $directory = 'categories/' . $name;
            Storage::disk('minio')->put($directory, file_get_contents($file));

            // Xóa hình củ trên minio storage
            Storage::disk('minio')->delete($category->image);

            // Update
            $category->update([
                'name' => $request['name'],
                'description' => $request['description'],
                'image' => $directory
            ]);
        } else {
            // Trường hợp không chỉnh sửa hình ảnh
            $category->update([
                'name' => $request['name'],
                'description' => $request['description']
            ]);
        }

        // Lấy lại danh sách categories mới nhất
        $categories = Category::with('products')->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'success' => true,
            'data' => $categories
        ], 200);
    }

    public function destroy(string $categoryId)
    {
        Category::findOrFail($categoryId)->update(['del_flg' => 1]);
        $categories = Category::with('products')->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'success' => true,
            'data' => $categories
        ], 200);
    }
}
