<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.login');
    }

    public function add()
    {
        return view('pages.register');
    }

    public function reset()
    {
        return view('pages.forgot-password');
    }

    public function validate(Request $request)
    {

    }
}
