<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $user = User::firstOrFail();
    
        return view('admin.user.index', [
            'user' => $user
        ]);
    }

    public function update(Request $request) {
        $data = $request->all();

        $password = Hash::make($data['password']);

        User::findOrFail($data['id'])->update([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'dob' => $data['dob'],
            'password' => $password,
            'avatar' => $data['avatar']
        ]);

        $user = User::firstOrFail();

        return view('admin.user.index', [
            'user' => $user
        ]);
    }
}
