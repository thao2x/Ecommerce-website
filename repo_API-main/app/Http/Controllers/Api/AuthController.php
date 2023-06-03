<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Customer;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'required' => 'The :attribute field is required.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data check error.',
                'data' => $validator->errors()
            ], 200);
        }

        if (!Auth::guard('customer')->attempt(["email" => $request['email'], "password" => $request['password']])) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
                'data' => []
            ], 401);
        }

        $user = Auth::guard('customer')->user();
        if ($user->del_flg == 1) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
                'data' => []
            ], 401);
        }

        $token = $user->createToken('Token')->accessToken;

        return response()->json([
            'success' => true,
            'token' => $token,
            'data' => $user
        ], 200);
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
                'message' => 'Data check error.',
                'data' => $validator->errors()
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

        Mail::send(
            'mail.new-account',
            array(
                'text' => 'Welcome ' . $customer->nick_name,
                'email' => $request['email'],
                'password' => $password,
            ),
            function ($message) use ($request) {
                $message->to($request['email'], 'POJO')->subject('Welcome to the POJO!');
            }
        );

        $token = $customer->createToken('Token')->accessToken;

        return response()->json([
            'success' => true,
            'token' => $token,
            'data' => $customer
        ], 200);
    }

    public function logout()
    {
        $accessToken = Auth::guard('api-customer')->user()->token();
        $accessToken->revoke();

        return response()->json([
            'success' => true,
            'message' => 'You have exited the application and the token has been removed'
        ], 200);
    }
}
