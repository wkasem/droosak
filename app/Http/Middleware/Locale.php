<?php

namespace droosak\Http\Middleware;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Closure;
use Carbon\Carbon;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      App::setLocale(Session::get('locale'));
      Carbon::setLocale(Session::get('locale'));

      return $next($request);
    }
}
