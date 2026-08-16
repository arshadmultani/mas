<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedLocales = ['hi', 'en'];

        // Determine locale from query param, session, cookie, or default to 'hi' (Hindi-first)
        $locale = $request->query('lang');

        if (! $locale || ! in_array($locale, $allowedLocales, true)) {
            $locale = Session::get('locale', $request->cookie('locale', 'hi'));
        }

        if (! in_array($locale, $allowedLocales, true)) {
            $locale = 'hi';
        }

        App::setLocale($locale);
        Session::put('locale', $locale);

        $response = $next($request);

        // Ensure cookie is attached with whatever final locale was set by controller or middleware
        if (method_exists($response, 'withCookie')) {
            $response->withCookie(cookie()->forever('locale', App::getLocale()));
        }

        return $response;
    }
}
