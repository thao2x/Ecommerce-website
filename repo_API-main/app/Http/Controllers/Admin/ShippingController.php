<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Shipping;

class ShippingController extends Controller
{
    public function index()
    {
        $shippings = Shipping::orderBy('created_at', 'DESC')->get();

        return view('admin.shipping', [
            'shippings' => $shippings
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->messages()
            ], 200);
        }

        Shipping::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'price' => $request['price']
        ]);

        $shippings = Shipping::orderBy('created_at', 'DESC')->get();

        return response()->json([
            'success' => true,
            'data' => $shippings
        ], 200);
    }

    public function show(string $shippingId)
    {
        $category = Shipping::findOrFail($shippingId);

        return response()->json([
            'success' => true,
            'data' => $category
        ], 200);
    }

    public function update(Request $request, string $shippingId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->messages()
            ], 200);
        }

        Shipping::findOrFail($shippingId)->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'price' => $request['price']
        ]);

        // Lấy lại danh sách shippings mới nhất
        $shippings = Shipping::orderBy('created_at', 'DESC')->get();

        return response()->json([
            'success' => true,
            'data' => $shippings
        ], 200);
    }

    public function destroy(string $shippingId)
    {
        Shipping::findOrFail($shippingId)->update(['del_flg' => 1]);
        $shippings = Shipping::orderBy('created_at', 'DESC')->get();

        return response()->json([
            'success' => true,
            'data' => $shippings
        ], 200);
    }
}
