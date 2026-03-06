<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authorize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if(auth()->status)
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }
        return redirect()->back()->withErrors(['error' => 'Anda tidak memiliki akses ke halaman ini.']);
    }
}
