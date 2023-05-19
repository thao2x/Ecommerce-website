<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return [type]
     *
     */
    public function index()
    {
        $user = Auth::guard('api-customer')->user();
        $address = ShippingAddress::where('customer_id', $user->id)->get();

        return response()->json([
            'status' => true,
            'message' => "List of shipping addresses",
            'data' => $address
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return [type]
     *
     */
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
            ], Response::HTTP_OK);
        }

        $address = ShippingAddress::create($request->all());
        return response()->json([
            'success' => true,
            'message' => "Address added successfully.",
            'data' => $address
        ], Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ShippingAddress $address
     *
     * @return [type]
     *
     */
    public function update(Request $request, ShippingAddress $address)
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
            ], Response::HTTP_OK);
        }

        $address->update([
            'name' => $request['name'],
            'details' => $request['details'],
        ]);

        return response()->json([
            'success' => true,
            'message' => "Address updated successfully",
            'data' => $address
        ], Response::HTTP_CREATED);
    }
}
