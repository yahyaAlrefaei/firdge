<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function logout()
    {
        Session::flush();

        Auth::logout();

        return redirect('login');
    }
    public  function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (auth()->user()->role == 1) {
                return redirect('admin/dashboard');
            } else if (auth()->user()->role == 2 && auth()->user()->status == "active") {
                return redirect('client/dashboard');
            } else {
                auth()->logout();
                return redirect('login');
            }
        }

        return back()->withErrors([
            'error' => 'The provided credentials do not match our records.',
        ]);
    }
}
