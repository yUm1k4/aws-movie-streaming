<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('member.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|numeric',
            'password' => 'required|min:6',
        ]);

        $data = $request->except('_token');
        $data['role'] = 'user';
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('member.login')->with('success', 'Register success, please login');
    }
}
