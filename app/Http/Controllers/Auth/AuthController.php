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
        ], [
            'username.required' => 'Username harus diisi!',
            'password.required' => 'Password harus diisi!'
        ]);

        $user = User::where('username', $credentials['username'])->first();


        // Attempt to authenticate the user
        if($user && $user->password && password_verify($credentials['password'], $user->password)){
            auth()->login($user);
            $request->session()->regenerate();

            $userRole = auth()->user()->role;
            if($userRole === 'admin'){
                return redirect('/admin');
            } else if ($userRole === 'user') {
                return redirect('/');
            }
            return redirect('/');
        }
{
}
        // Authentication failed, redirect back with error message
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }
    public function logout(Request $request)
    {

        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}
