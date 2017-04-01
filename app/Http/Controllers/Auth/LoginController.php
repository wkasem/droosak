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


    protected $authedWith = 'email';

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
      if(is_numeric(request('email'))){
        $phoneNum = request('login_mobile_code').request('email');

        $request->merge( ['phone_number' => $phoneNum ] );
        $this->authedWith = 'phone_number';
      }

      $user = \droosak\User::where('email' , request('email'))
                           ->orWhere('phone_number' , request('phone_number'))
                           ->first();

      if($user){
        if($user->type_id == 3){
           $request->merge(['ip' => $request->ip()]);

           return $request->only($this->authedWith, 'password' , 'ip');
        }
      }
      return $request->only($this->authedWith, 'password');

    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->has('remember')
        );
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

      if(auth()->user()->type_id == 3) return '/courses';

      return '/home';
    }
}
