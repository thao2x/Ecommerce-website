<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Variant;

class VariantController extends Controller
{
    public function store(Request $request)
    {
        $messages = [
            'size.required' => 'Kích thước là bắt buộc.'
        ];

        $validator = Validator::make($request->all(), [
            'size' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->messages()
            ], 200);
        }

        Variant::create([
            'product_id' => $request['product_id'],
            'size' => $request['size']
        ]);

        $variants = Variant::where('product_id', $request['product_id'])->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $variants
        ], 200);
    }

    public function show(string $variantId)
    {
        $variant = Variant::findOrFail($variantId);

        return response()->json([
            'success' => true,
            'data' => $variant
        ], 200);
    }

    public function update(Request $request, string $variantId)
    {
        $messages = [
            'size.required' => 'Kích thước là bắt buộc.'
        ];

        $validator = Validator::make($request->all(), [
            'size' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->messages()
            ], 200);
        }

        Variant::find($variantId)->updated([
            'size' => $request['size']
        ]);

        $variants = Variant::where('product_id', $request['product_id'])->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $variants
        ], 200);
    }

    public function destroy(Request $request, string $variantId)
    {
        Variant::findOrFail($variantId)->update(['del_flg' => 1]);
        $variants = Variant::where('product_id', $request['product_id'])->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $variants
        ], 200);
    }
}
