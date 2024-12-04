<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Localization;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Tambahkan middleware ke pipeline global
        $middleware->append(Localization::class); // Middleware Anda ditambahkan di sini
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Konfigurasi exception handler di sini
    })
    ->create();
