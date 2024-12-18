<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->header('Accept-Language');
        
        // Varsayılan dil az, desteklenen diller: az, en, ru
        if (!in_array($locale, ['az', 'en', 'ru'])) {
            $locale = 'az';
        }
        
        app()->setLocale($locale);
        
        return $next($request);
    }
} 