<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class LoginController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //admin credentials
        $adminEmail = 'admin@example.com';
        $adminPassword = 'admin123';

        
        if ($request->email === $adminEmail && $request->password === $adminPassword) {
            session(['role' => 'admin']);
            $redirect = $request->input('redirect', '/');

            return redirect()->to($redirect)->with('success', 'Logged in as admin!');
        }

        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            // If user has 2FA enabled and confirmed, start Fortify two-factor challenge
            if (optional($user)->two_factor_secret
                //&& ! is_null(optional($user)->two_factor_confirmed_at)
                && in_array(\Laravel\Fortify\TwoFactorAuthenticatable::class, class_uses_recursive($user))) {

                session([
                    'login.id' => $user->getKey(),
                    'login.remember' => $request->boolean('remember'),
                ]);

                return redirect()->route('two-factor.login');
            }

            // No 2FA, log the user in
            auth()->login($user, $request->boolean('remember'));
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
