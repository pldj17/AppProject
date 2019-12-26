<?php

namespace ProjectApp\Http\Controllers\Auth;

use ProjectApp\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use ProjectApp\role;

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
    protected $redirectTo = '/home';

    // protected function redirectTo()
    // {
    //     if(Auth::user()->roles()->attach(role::where('name', 'admin')->first()))
    //     {
    //         return 'dashboard';
    //     }else
    //     {
    //         return '/'; 
    //     }
    // }


    // if(Auth::user()->authorizeRoles(['admin']))
    // {
    //     return 'dashboard';
    // }else
    // {
    //     return 'dashboard'; 
    // }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
