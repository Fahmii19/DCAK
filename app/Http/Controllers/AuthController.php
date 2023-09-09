<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User_dcak;

class AuthController extends Controller
{
    // public function showLoginForm()
    // {
    //     return view('login-user.login');
    // }

    public function showLoginFormAdmin()
    {
        return view('dcak.login.index');
    }

    public function loginProcessAdmin(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['message' => 'Username atau password salah']);
    }

    public function logoutAdmin()
    {
        Auth::logout();
        return redirect('/admin');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['message' => 'Username atau password salah']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
