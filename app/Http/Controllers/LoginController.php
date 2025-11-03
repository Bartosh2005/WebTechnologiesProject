<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt([
            'email' => request('email'),
            'password' => request('password'),
        ])) {
            $redirect = $request->input('redirect', '/');

            return redirect($redirect)->with('success', 'You are now logged in!');
        }

        return back()->with('error', 'Invalid credentials.');
    }

    public function logout()
    {

        auth()->logout();

        return redirect('/login')->with('success', 'You have been logged out.');
    }
}
