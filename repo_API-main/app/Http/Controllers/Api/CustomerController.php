<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Get user information
     *
     * @return [type]
     *
     */
    public function index()
    {
        $customer = Auth::guard('api-customer')->user();

        return response()->json([
            'status' => true,
            'message' => "User information",
            'data' => $customer
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Customer $customer
     *
     * @return [type]
     *
     */
    public function update(Request $request, Customer $customer)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
            'full_name' => ['string'],
            'nick_name' => ['required'],
            'dob' => ['string'],
            'phone' => ['string'],
            'gender' => ['string']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data check error.',
                'data' => $validator->errors()
            ], Response::HTTP_OK);
        }

        $customer->update([
            'full_name' => $request['full_name'],
            'nick_name' => $request['nick_name'],
            'dob' => $request['dob'],
            'email' => $request['email'],
            'password' => $request['password'],
            'phone' => $request['phone'],
            'gender' => $request['gender'],
            'avatar' => $request['avatar'],
            'pin' => $request['pin']
        ]);

        return response()->json([
            'success' => true,
            'message' => "User updated successfully",
            'data' => $customer
        ], Response::HTTP_CREATED);
    }
}
