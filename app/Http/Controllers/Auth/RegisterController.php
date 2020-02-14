<?php

namespace ProjectApp\Http\Controllers\Auth;

use GuzzleHttp\Psr7\Request;
use ProjectApp\User;
use ProjectApp\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use ProjectApp\Profile;
use ProjectApp\Role;


class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'regex:/^[\pL\s\-]+$/u', 'max:30'],
            'last_name' => ['required', 'regex:/^[\pL\s\-]+$/u', 'max:30'],
            'date_born' => ['required', 'date'],
            'name' => ['string', 'max:255'],    
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([ //profile
            'name' => $data['first_name'].' '.$data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        Profile::create([
            'user_id' => $user->id, 
            'date_born' => request('date_born'),
        ]);

        //  $user->roles()->attach(Role::where('name', 'user')->first()); //pedimos el rol con el nombre user, attach se encarga de las tablas relacionadas
        
        // return $user;
        //asignar rol de usuario al registrarse
        $role = Role::select('id')->where('name','user')->first(); //especialidad
        $user->roles()->attach($role);
        return $user;
    }

    // protected function authenticated(Request $request, $user)
    // {
    //     $roles = $user->roles()->get();
    //     if ($roles->isNotEmpty()) {
    //         $user->setSession($roles->toArray());
    //     } else {
    //         $this->guard()->logout();
    //         $request->session()->invalidate();
    //         return redirect('login')->withErrors(['error' => 'Este usuario no tiene un rol activo']);
    //     }
    // }
}
