<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Auth::guard('api-customer')->user();

        return response()->json([
            'status' => true,
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
            'gender' => ['string']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data check error.',
                'data' => $validator->errors()
            ], 200);
        }

        $directory = $request['avatar'];
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . $file->getClientOriginalName();
            $directory = '/images/customers/' . $name;
            Storage::disk('public')->put($directory, file_get_contents($file));
        }

        $customer = Auth::guard('api-customer')->user();
        $customer->update([
            'full_name' => $request['full_name'],
            'nick_name' => $request['nick_name'],
            'dob' => $request['dob'],
            'email' => $request['email'],
            'password' => $request['password'],
            'phone' => $request['phone'],
            'gender' => $request['gender'],
            'avatar' => $directory,
            'pin' => $request['pin']
        ]);

        return response()->json([
            'success' => true,
            'message' => "User updated successfully",
            'data' => $customer
        ], 201);
    }
}
