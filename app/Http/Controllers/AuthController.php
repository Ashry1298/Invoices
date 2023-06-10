<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function handleLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|min:5|max:100',
            'password' => 'required|min:8',
        ]);
        $is_user = Auth::attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ]
        );
        if (!$is_user) {
            return redirect()->back()->with(
                'error' ,'The provided credentials do not match our records.'
            );
        }
        return redirect()->route('home');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginView');
    }
}
