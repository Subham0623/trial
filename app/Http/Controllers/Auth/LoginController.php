<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;


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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectPath()
    {
        if (auth()->user()->is_admin) {
            return route('admin.home');
        }

        return route('user.home');
    }

    protected function credentials(Request $request)
    {
        $username = $request->email; //the input field has name='email' in form

        if(filter_var($username, FILTER_VALIDATE_EMAIL))    
        {
            //user sent their email 
           $credentials = [
               'email' => $username,
               'password' => $request->password,
               'status' => 1,
           ];
        } 
        else 
        {
            //they sent their token instead 
            $credentials = [
                'token' => $username,
                'password' => $request->password,
                'status' => 1,
            ];
        }

        return $credentials;
    }
}
