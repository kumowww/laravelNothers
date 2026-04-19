<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocaleValidation
{
    protected array $validLocales = ['en', 'ru', 'de'];

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale');

        if (!in_array($locale, $this->validLocales)) {
            return redirect('/en');
        }

        app()->setLocale($locale);

        return $next($request);
    }
}