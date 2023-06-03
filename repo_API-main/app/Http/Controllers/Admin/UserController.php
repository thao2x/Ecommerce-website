<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.user', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'full_name' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $password = Hash::make($request['password']);
        $user = Auth::user();
        $directory = $user->avatar;

        // Trường hợp có chỉnh sửa hình ảnh
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $name = time() . $file->getClientOriginalName();
            $directory = '/images/user/' . $name;
            Storage::disk('public')->put($directory, file_get_contents($file));
        }

        $user->update([
            'full_name' => $request['full_name'],
            'email' => $request['email'],
            'dob' => $request['dob'],
            'password' => $password,
            'avatar' => $directory
        ]);

        return redirect()->back();
    }
}
