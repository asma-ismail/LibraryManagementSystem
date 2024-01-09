<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!$request->segments()) {
            return redirect("/" . App::getLocale());
        }
        $lang = $request->segments()[0];
        if ($request->segments()) {
            if (!in_array($lang, ['ku', 'en'])) {
                return redirect("/" . App::getLocale() . "/" . $request->segments()[0]);

            }
        } else {
            redirect("/" . App::getLocale());
        }

        App::setLocale($lang);
        URL::defaults(['lang' => App::getLocale()]);

        return $next($request);
    }
}
