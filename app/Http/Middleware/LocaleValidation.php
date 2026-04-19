<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class LocaleValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->header('Accept-Language');

        if ($locale && !in_array($locale, config('app.locales'))) {
            return response()->json(['error' => 'Unsupported locale'], 400);
        }

        App::setLocale($locale);

        return $next($request);
    }
}