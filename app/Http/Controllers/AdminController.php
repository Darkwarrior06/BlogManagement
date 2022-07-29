<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login()
    {
        return view('layouts/login');
    }

    public function check_login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if(Auth::attempt($credentials))
        {
            return response()->json(['status' => 'success', 200]);
        }

        return response()->json(['error' => 'login_error'], 401);
    }

    public function logout()
    {
        Auth::logout();
        
        return redirect('/');
    }
}
