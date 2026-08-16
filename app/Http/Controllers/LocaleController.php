<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    /**
     * Switch application locale and redirect back preserving query and hash context.
     */
    public function switch(Request $request, string $locale): RedirectResponse
    {
        if (! in_array($locale, ['hi', 'en'], true)) {
            $locale = 'hi';
        }

        Session::put('locale', $locale);
        App::setLocale($locale);

        $previousUrl = url()->previous();
        $fallback = route('dashboard');

        $targetUrl = $previousUrl ?: $fallback;

        // If a redirect URL parameter was passed explicitly
        if ($request->filled('return_url')) {
            $targetUrl = $request->query('return_url');
        }

        return redirect($targetUrl)
            ->withCookie(cookie()->forever('locale', $locale));
    }
}
