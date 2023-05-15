<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $messages = [
            'email.required' => 'Trường email là bắt buộc.',
            'descrpasswordiption.required' => 'Trường password là bắt buộc.',
            'email' => 'Email phải là một địa chỉ email hợp lệ.',
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->messages()
            ], 200);
        }

        if (\Auth::guard('customer')->attempt(["email" => $request['email'], "password" => $request['password']])) {
            $user = \Auth::guard('customer')->user();
            $token = $user->createToken('My Token')->accessToken;

            return response()->json([
                'success' => true,
                'token' => $token,
                'data' => $user
            ], 200);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'unique:customers'],
            'password' => ['required'],
            'full_name' => ['string'],
            'nick_name' => ['required'],
            'dob' => ['string'],
            'phone' => ['string'],
            'gender' => ['string'],
            'avatar' => ['string'],
            'pin' => ['string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->messages()
            ], 200);
        }

	    $password = Hash::make($request['password']);

        $customer = Customer::create([
            'full_name' => $request['full_name'],
            'nick_name' => $request['nick_name'],
            'dob' => $request['dob'],
            'email' => $request['email'],
            'password' => $password,
            'phone' => $request['phone'],
            'gender' => $request['gender'],
            'avatar' => $request['avatar'],
            'pin' => $request['pin']
        ]);

        $token = $customer->createToken('My Token')->accessToken;
        return response()->json([
            'success' => true,
            'token' => $token,
            'data' => $customer
        ], 200);
    }

    public function logout()
    {
        $accessToken = \Auth::guard('api-customer')->user()->token();
        $accessToken->revoke();
        return response()->json([
            'success' => true
        ], 200);
    }
}