<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category');
    }

    public function data()
    {
        $categories = Category::with('products')->where('del_flg', 0)->orderBy('created_at', 'DESC')->get();

        return Datatables::of($categories)->make();
    }

    public function create()
    {
        return view('admin.category-create');
    }

    public function store(Request $request)
    {
        $directory = "";

        // Add Category Image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . $file->getClientOriginalName();
            $directory = '/images/categories/' . $name;
            Storage::disk('public')->put($directory, file_get_contents($file));
        }

        // Add Category
        Category::create([
            'name' => $request['name'],
            'image' => $directory,
            'description' => $request['description']
        ]);

        return redirect()->route('admin.category.index');
    }

    public function show(string $categoryId)
    {
        $category = Category::findOrFail($categoryId);

        return view('admin.category-detail', [
            'category' => $category
        ]);
    }

    public function update(Request $request, string $categoryId)
    {
        // Add Category
        $category = Category::find($categoryId);
        $directory = $category->image;

        // Add Category Image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . $file->getClientOriginalName();
            $directory = '/images/categories/' . $name;
            Storage::disk('public')->put($directory, file_get_contents($file));
        }

        // Add Category
        $category->update([
            'name' => $request['name'],
            'image' => $directory,
            'description' => $request['description']
        ]);

        return redirect()->route('admin.category.index');
    }

    public function destroy(string $categoryId)
    {
        Category::findOrFail($categoryId)->update(['del_flg' => 1]);
        return redirect()->route('admin.category.index');
    }
}
