<?php

namespace App\Http\Controllers;

use App\Models\Users;
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
        $inputs = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = Users::authenticate($inputs);
        if(is_null($user))
        {
            return redirect()->route('signin')->with('message', 'Invalid credentials.');
        }

        // Create user data to pass in session
        $userData = new \stdClass();
        $userData->id = md5($user->usr_id);
        $userData->firstname = $user->usr_fname;
        $userData->lastname = $user->usr_lname;
        $userData->menus = $user->menus($user->rl_id);
        session()->put('user', $userData);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}
