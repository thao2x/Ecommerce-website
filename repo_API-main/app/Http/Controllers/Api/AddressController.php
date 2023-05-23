<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function index()
    {
        $user = Auth::guard('api-customer')->user();
        $address = ShippingAddress::where('customer_id', $user->id)->get();

        return response()->json([
            'status' => true,
            'message' => "List of shipping addresses",
            'data' => $address
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => ['required'],
            'name' => ['required'],
            'details' => ['required'],
            'default_flg' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data check error.',
                'data' => $validator->errors()
            ], 200);
        }

        $address = ShippingAddress::create($request->all());
        return response()->json([
            'success' => true,
            'message' => "Address added successfully.",
            'data' => $address
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'details' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data check error.',
                'data' => $validator->errors()
            ], 200);
        }

        $address = ShippingAddress::findOrFail($id);
        $address->update([
            'name' => $request['name'],
            'details' => $request['details'],
        ]);

        return response()->json([
            'success' => true,
            'message' => "Address updated successfully",
            'data' => $address
        ], 201);
    }
}
