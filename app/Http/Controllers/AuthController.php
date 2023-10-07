<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function createLogin()
    {
        return view("auth.login");
    }

    public function storeLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors("auth" , "email or password is wrong");
    }

    public function createSignup()
    {
        return view("auth.signup");
    }

    public function storeSignup(Request $request)
    {
        $credential = $request->validate([
            "name" => ["required"],
            "email" => ["required","email"],
            "password" => ["required"],
            "position" => ["required"]
        ]);

        $credential["password"] = bcrypt($request->password);
        $credential["nk"] = (string)rand(100000000000000, 999999999999999);

        User::create($credential);

        return redirect()->route("login");

    }
}
