<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $supported = ['sw', 'en'];
        $locale = Session::get('locale', 'sw');
        if (!in_array($locale, $supported)) {
            $locale = 'sw';
        }
        App::setLocale($locale);
        Session::put('locale', $locale);

        return $next($request);
    }
}
