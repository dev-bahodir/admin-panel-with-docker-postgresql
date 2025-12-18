<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $data = $request->only('email', 'password');

        if (Auth::attempt($data)) {
            return redirect('/admin');
        }

        return back()->withErrors(['email' => 'Login yoki parol xato']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
