<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request and set the application locale.
     *
     * Priority: Query Parameter > URL Segment > Session > Config Default
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $this->determineLocale($request);

        App::setLocale($locale);
        session(['app_locale' => $locale]);

        return $next($request);
    }

    /**
     * Determine the appropriate locale based on request context.
     */
    private function determineLocale(Request $request): string
    {
        $availableLocales = config('locales.available', ['en', 'fa']);
        $defaultLocale = config('locales.default', 'fa');

        // Priority 1: Query parameter (?lang=fa)
        if ($request->has('lang')) {
            $queryLocale = $request->query('lang');
            if (in_array($queryLocale, $availableLocales, true)) {
                return $queryLocale;
            }
        }

        // Priority 2: URL segment (/fa/page)
        $firstSegment = $request->segment(1);
        if ($firstSegment && in_array($firstSegment, $availableLocales, true)) {
            return $firstSegment;
        }

        // Priority 3: Session
        $sessionLocale = session('app_locale');
        if ($sessionLocale && in_array($sessionLocale, $availableLocales, true)) {
            return $sessionLocale;
        }

        // Priority 4: Default from config
        return $defaultLocale;
    }
}
