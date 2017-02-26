<?php

namespace droosak\Http\Controllers\Auth;

use Notification;
use droosak\User;
use droosak\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use droosak\Notifications\UserRegistration;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $v = Validator::make($data, [
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'phone_number' => 'required|number|min:6|max:15|unique:users',
        ]);

        session()->flash('signup_process' , true);

        return $v;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $phoneCode = mt_rand(1000,9999);
        $mailCode = str_random(5);

        $data['phone_number'] = '2'.$data['phone_number'];

        $user =  User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone_number' => $data['phone_number'],
            'phone_code' => $phoneCode,
            'mail_code' => $mailCode,
            'type_id' => 3,
            'ip' => request()->ip()
        ]);

        //Notification::send($user, new UserRegistration($phoneCode , $mailCode));

       return $user;
    }
}
