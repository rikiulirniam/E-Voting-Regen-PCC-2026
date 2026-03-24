<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsurePesertaNotVoted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'user') {
            $peserta = Auth::user()->peserta;

            if ($peserta && $peserta->status_vote === 'sudah') {
                $logoutUrl = route('logout');

                return response(
                    '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Sudah Vote</title></head><body><script>alert("Anda sudah vote. Klik OK untuk logout.");window.location.href=' . json_encode($logoutUrl) . ';</script></body></html>',
                    200,
                    ['Content-Type' => 'text/html; charset=UTF-8']
                );
            }
        }

        return $next($request);
    }
}
