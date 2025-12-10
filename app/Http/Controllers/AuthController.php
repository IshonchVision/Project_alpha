<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login_blade()
    {
        return view("auth/login");
    }

    public function register_blade()
    {
        return view("auth.register");
    }
}
