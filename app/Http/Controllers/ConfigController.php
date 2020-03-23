<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use ProjectApp\Http\Requests\ValidationPassword;
use ProjectApp\Profile;
use ProjectApp\User;

class ConfigController extends Controller
{

    public function index(User $user)
    {
        $id = $user->id;

        $perfil = Profile::all()->where('user_id', $id)->first();
        $user = User::with('especialidades')->find($id);

        return view('profile.ajustes.config', compact('perfil', 'user'));
    }


    public function store(user $user)
    {
        $id = $user->id;

        Profile::where('user_id', $id)->update([
            'private' => request('private')
        ]);
        
        return redirect()->back()->with('mensaje', 'Su perfil ha sido actualizado correctamente');
    }

    public function password(ValidationPassword $request)
    {
        $user_id = auth()->user()->id; 

        User::where('id', $user_id)->update([
            'password' => Hash::make($request->get('password'))
        ]);
        

        return back()->with('mensaje', 'Su perfil ha sido actualizado correctamente.');
    }

    public function update(Request $request)
    {
        $user_id = auth()->user()->id; 

        User::where('id', $user_id)->update([
            'name' => request('name'),
            'email' => request('email'),
        ]);
        

        return redirect()->back()->with('mensaje', 'Su perfil ha sido actualizado correctamente.');
    }

    public function destroy($id)
    {
        //
    }
}
