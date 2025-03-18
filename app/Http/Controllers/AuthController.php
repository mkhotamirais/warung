<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // validate
        $fields = $request->validate([
            "name" => "required|max:255",
            "email" => "required|max:255|email|unique:users",
            "password" => "required|min:3|confirmed",
        ]);
        // register
        $user = User::create($fields);

        // Login
        Auth::login($user);

        // verify email
        event(new Registered($user));

        // Redirect
        return redirect()->route('dashboard');
    }

    public function login(Request $request)
    {
        // validate
        $fields = $request->validate([
            "email" => "required|max:255|email",
            "password" => "required",
        ]);

        // Cek apakah email terdaftar
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            // return back()->withErrors([
            //     'error' => 'Invalid credentials.'
            // ]);
            return back()->with('error', 'Email atau password salah.');
        }

        // Try to login
        if (Auth::attempt($fields, $request->remember)) {
            // return redirect()->route('dashboard');
            return redirect()->intended();
        } else {
            return back()->with('error', 'Email atau password salah..');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('dashboard');
    }


    public function verifyNotice()
    {
        return view('auth.verify-email');
    }

    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('dashboard');
    }

    public function resendVerifyEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }
}
