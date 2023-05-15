<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $messages = [
            'email.required' => 'Trường email là bắt buộc.',
            'password.required' => 'Trường password là bắt buộc.',
            'email' => 'Email phải là một địa chỉ email hợp lệ.',
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt(["email" => $request['email'], "password" => $request['password']])) {
            return redirect()->route('admin.home');
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập được cung cấp không khớp với hồ sơ của chúng tôi.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('guest');
    }
}