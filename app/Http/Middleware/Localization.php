<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\SettingsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Localization
{
    /**
     * If the session has the lng variable, set the localization with the session data
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $locale = (new SettingsUser())->getLanguageUser();
            App::setlocale($locale);
        }else{
            if (session()->has('locale')) {
                App::setlocale(session()->get('locale'));
            }
        }

        return $next($request);
    }
}
