<?php

namespace ProjectApp\Http\Controllers\Auth;

use Illuminate\Http\Request;
use ProjectApp\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use ProjectApp\role;
use ProjectApp\User;

class LoginController extends Controller
{
   
    use AuthenticatesUsers;

    protected $redirectTo = '/';
   
    
   
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        User::where('id', auth()->user()->id)->update(['active' => $request->active]);

        User::where('id', auth()->user()->id)->update(['device_token' => $request->device_token]);
        
        $roles = $user->roles()->get();
        if ($roles->isNotEmpty()) {
            $user->setSession($roles->toArray());
        } else {
            $this->guard()->logout();
            $request->session()->invalidate();
            return redirect('login')->withErrors(['error' => 'Este usuario no tiene un rol activo']);
        }
    }


}
