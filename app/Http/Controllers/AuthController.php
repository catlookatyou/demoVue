<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $user = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if(Auth::guard()->attempt($user)){
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function logout(Request $request){
        Auth::guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
