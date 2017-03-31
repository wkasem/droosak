<?php

namespace droosak\Http\Middleware;

use Closure;

class Verfied
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
      // if(\Auth::check()){
      //   if(auth()->user()->phone_code || auth()->user()->mail_code != ""){
      //     if(\Route::currentRouteName() != "errors.validation" && basename(\URL::previous()) != "validation"){
      //
      //       return redirect()->route('errors.validation');
      //     }
      //   }
      //
      //   if(!auth()->user()->phone_code && auth()->user()->mail_code == "" && \Route::currentRouteName() == "errors.validation"){
      //
      //     return redirect('/');
      //   }
      // }
        return $next($request);
    }
}
