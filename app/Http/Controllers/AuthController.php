<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required','string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'E-posta veya şifre hatalı.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'tc'         => ['required','digits:11','unique:users,tc'],
            'name'       => ['required','string','max:255'],
            'email'      => ['required','email','max:255','unique:users,email'],
            'phone'      => ['nullable','string','max:15'],
            'birth_date' => ['nullable','date'],
            'password'   => ['required','string','min:6','confirmed'],
        ]);

        $user = User::create([
            'tc'         => $data['tc'],
            'name'       => $data['name'],
            'email'      => $data['email'],
            'phone'      => $data['phone'],
            'birth_date' => $data['birth_date'],
            'password'   => Hash::make($data['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
    