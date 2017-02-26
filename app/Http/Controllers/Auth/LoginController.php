<?php

namespace droosak\Http\Controllers\Auth;

use Illuminate\Http\Request;
use droosak\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return redirect('/');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
      $user = \droosak\User::where('email' , request('email'))->first();

      if($user){
        if($user->type_id == 3){
           $request->merge(['ip' => $request->ip()]);
           return $request->only($this->username(), 'password' , 'ip');
        }
      }
      return $request->only($this->username(), 'password');

    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function redirectTo()
    {
      if(auth()->user()->type_id == 1) return '/admin';

      return '/home';
    }
}
