<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function show_login_view() // index
    {
        return view('layout.admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->guard('admin')->attempt(
            [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ]
        )) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->with('error', 'البريد الالكتروني او كلمه السر غير صحيحه');
        }
    }

    public function logout()
    {
        // auth()->guard('admin')->logout();
        auth()->logout();
        return redirect()->route('admin.showlogin');
    }
}