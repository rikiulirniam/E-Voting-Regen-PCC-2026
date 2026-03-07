<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view("pages.auth.login");
    }
    public function authenticate(Request $request)
    {
        // Validate the request data
        $credentials = $request->validate([
            'username' => ['required', 'min:4'],
            'password' => ['required', 'min:8'],
        ]);

        $user = User::where('username', $credentials['username'])->first();


        // Attempt to authenticate the user
        if($user && $user->password && password_verify($credentials['password'], $user->password)){
            auth()->login($user);
            $request->session()->regenerate();

            if(auth()->user()->role === 'admin'){
                return redirect('/admin');
            }
            return redirect('/');
        }

        // Authentication failed, redirect back with error message
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}
