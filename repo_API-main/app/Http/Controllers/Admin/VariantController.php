<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Variant;

class VariantController extends Controller
{

    public function store(Request $request) {
        $data = $request->all();

        Variant::create([
            'product_id' => $data['product_id'],
            'size' => $data['size']
        ]);

        $variants = Variant::where('product_id', $data['product_id'])->orderBy('created_at', 'desc')->get();

        return response()->json($variants, 200);
    }

    public function update(Request $request) {
        $data = $request->all();

        Variant::findOrFail($data['id'])->update([
            'product_id' => $data['product_id'],
            'size' => $data['size']
        ]);

        $variants = Variant::where('product_id', $data['product_id'])->orderBy('created_at', 'desc')->get();

        return response()->json($variants, 200);
    }

    public function show($id) {
        $variant = Variant::findOrFail($id);

        return response()->json($variant, 200);
    }


    public function destroy(Request $request, string $id) {
        $data = $request->all();
        Variant::findOrFail($id)->update(['del_flg' => 1]);
        $variants = Variant::where('product_id', $data['product_id'])->orderBy('created_at', 'desc')->get();
        return response()->json($variants, 200);
    }
}
