<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\EnsurePesertaNotVoted;
use App\Http\Middleware\NoCache;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'peserta.not_voted' => EnsurePesertaNotVoted::class,
            'nocache' => NoCache::class,
            
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

