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

        // new: here we hardcode admin credentials
        $adminEmail = 'admin@example.com';
        $adminPassword = 'admin123';

        // new: here it checks if the credentials are actually admin, then gives admin role
        if ($request->email === $adminEmail && $request->password === $adminPassword) {
            session(['role' => 'admin']);
            $redirect = $request->input('redirect', '/');

            return redirect()->to($redirect)->with('success', 'Logged in as admin!');
        }

        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            // new: below added user role for the regular login
            session(['role' => 'user']);
            $redirect = $request->input('redirect', '/');

            return redirect()->to($redirect)->with('success', 'You are now logged in!');
        }

        return back()->with('error', 'Invalid credentials.');
    }

    public function logout()
    {

        auth()->logout();
        session()->forget('role');

        return redirect('/login')->with('success', 'You have been logged out.');
    }
}
