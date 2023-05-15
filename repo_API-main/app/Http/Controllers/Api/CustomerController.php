<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = \Auth::guard('api-customer')->user();
        return response()->json([
            'success' => true,
            'data' => $customer
        ], 200);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
            'full_name' => ['string'],
            'nick_name' => ['required'],
            'dob' => ['string'],
            'phone' => ['string'],
            'gender' => ['string'],
            // 'avatar' => ['string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->messages()
            ], 200);
        }

        Customer::find($request['id'])->update([
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

        $customer = Customer::find($request['id']);

        return response()->json([
            'success' => true,
            'data' => $customer
        ], 200);
    }
}