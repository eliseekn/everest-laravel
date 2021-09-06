<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function login(AuthRequest $authRequest)
    {
        if (!Auth::attempt($authRequest->validated())) {
            return back()->withInput($authRequest->input())->with('error', 'Invalid email address or password');
        }

        $authRequest->session()->regenerate();
        return redirect()->intended('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}