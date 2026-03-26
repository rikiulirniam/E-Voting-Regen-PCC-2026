<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view("pages.auth.login");
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'min:4'],
            'password' => ['required', 'min:8'],
        ], [
            'username.required' => 'Username harus diisi!',
            'username.min' => 'Username minimal 4 karakter.',
            'password.required' => 'Password harus diisi!',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        $user = User::where('username', $credentials['username'])->first();


        if ($user && $user->password && password_verify($credentials['password'], $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();

            $userRole = Auth::user()->role;
            if ($userRole === 'admin') {
                return redirect('/admin');
            } else if ($userRole === 'user') {
                return redirect('/');
            }

            return redirect('/');
        }

        return back()->withErrors([
            'login' => 'Username atau password tidak sesuai.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
