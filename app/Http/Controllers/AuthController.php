<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        if (Auth::attempt([
            'username' => $username,
            'password' => $password
        ])) {
            return "Berhasil Masuk";
        } else {
            return "Gagal Masuk";
        }
    }
}
