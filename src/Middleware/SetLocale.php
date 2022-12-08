<?php
namespace Savannabits\JetstreamInertiaGenerator\Middleware;

use Closure;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        app()->setLocale(config('app.locale'));

        if(session()->has('locale')) {
            app()->setLocale(session('locale'));
        }

        return $next($request);
    }
}
