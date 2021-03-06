<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function authenticate()
    {   
        $remember = Input::has('remember') ? true : false;

        if (Auth::attempt(['email' => $email, 'password' => $password], $remember))
        {
            return redirect()->intended('dashboard');
        } else {
            return Redirect::to('/login')
                ->withInput(Input::except('password'))
                ->with('flash_notice', 'Your username/password combination was incorrect.');
        }
    }

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'sex' => 'required',
            'date_of_birth' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    // 'date_of_birth' => Carbon::createFromFormat('Y-m-d', $data['date_of_birth'])->toDateString(),
    protected function create(array $data)
    {   
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'sex' => $data['sex'],
            'date_of_birth' => Carbon::parse($data['date_of_birth']),

        ]);
    }
}
