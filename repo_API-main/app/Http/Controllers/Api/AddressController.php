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
        $address = ShippingAddress::where('customer_id', $user->id)->where('del_flg', 0)->get();

        return response()->json([
            'status' => true,
            'message' => "List of shipping addresses",
            'data' => $address
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'details' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data check error.',
                'data' => $validator->errors()
            ], 200);
        }

        $user = Auth::guard('api-customer')->user();
        $address =  ShippingAddress::create([
            'customer_id' => $user->id,
            'name' => $request['name'],
            'details' => $request['details'],
        ]);

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

        $address = ShippingAddress::where('del_flg', 0)->findOrFail($id);
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
