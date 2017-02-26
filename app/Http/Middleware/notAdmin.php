<?php

namespace droosak\Http\Middleware;

use Closure;

class notAdmin
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
        if(admin()){
          return redirect('/admin');
        }

        if(student()){
          \Exam::worker();
        }
        
        return $next($request);
    }
}
