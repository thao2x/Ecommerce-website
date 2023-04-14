<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.category.index', [
            'categories' => $categories
        ]);
    }

    public function show($id) {
        $category = Category::findOrFail($id);

        return view('admin.category.detail', [
            'category' => $category
        ]);
    }

    public function create() {
        return view('admin.category.create', []);
    }

    public function store(Request $request) {
        $data = $request->all();
        Category::create($data);

        $categories = Category::orderBy('created_at', 'DESC')->paginate(10);
        
        return view('admin.category.index', [
            'categories' => $categories
        ]);
    }

    public function update(Request $request) {
        $data = $request->all();

        Category::findOrFail($data['id'])->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'image' => $data['image']
        ]);

        $categories = Category::orderBy('created_at', 'DESC')->paginate(10);
        
        return view('admin.category.index', [
            'categories' => $categories
        ]);
    }

    public function destroy($id) {
        Category::findOrFail($id)->update(['del_flg' => 1]);
        $categories = Category::orderBy('created_at', 'DESC')->paginate(10);
        
        return view('admin.category.index', [
            'categories' => $categories
        ]);
    }
}
