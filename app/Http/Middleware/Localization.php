<?php

namespace App\Http\Middleware;

use Closure;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Mengambil bahasa dari sesi
        $locale = session('locale', 'id');
        app()->setLocale($locale);

        return $next($request);
    }
}

