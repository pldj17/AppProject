<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use ProjectApp\Http\Requests\ValidarConfig;
use ProjectApp\Http\Requests\ValidarEmail;
use ProjectApp\Http\Requests\ValidationPassword;
use ProjectApp\Profile;
use ProjectApp\Rating;
use ProjectApp\User;

class ConfigController extends Controller
{

    public function index(User $user)
    {
        $id = $user->id;

        $perfil = Profile::with('especialidades')->where('user_id', $id)->first();
        $user = User::find($id);

        return view('profile.ajustes.config', compact('perfil', 'user'));
    }

    public function editName($id)
    {
        $data = User::findOrFail($id);  
        return view('profile.ajustes.editName', compact('data'));
    }

    public function store(user $user)
    {
        $id = $user->id;
        $rating = new Rating();
        $rating->rating = 0;
        $rating->profile_id = $id;
        $rating->save();
        Profile::where('user_id', $id)->update([
            'private' => request('private')
        ]);
        
        return redirect()->back()->with('mensaje', 'Su perfil ha sido actualizado correctamente');
    }

    public function active(user $user)
    {
        $id = $user->id;
        User::where('id', $id)->update([
            'active' => request('active')
        ]);

        Auth::logout();
        return redirect('/');
    }

    public function password(ValidationPassword $request)
    {
        $user_id = auth()->user()->id; 

        User::where('id', $user_id)->update([
            'password' => Hash::make($request->get('password'))
        ]);
        

        return back()->with('mensaje', 'Su perfil ha sido actualizado correctamente.');
    }

    public function updateName(ValidarConfig $request)
    {
        
        $user_id = auth()->user()->id; 

        User::where('id', $user_id)->update([
            'name' => $request['name'].' '.$request['lastName']
        ]);
        

        return redirect()->back()->with('mensaje', 'Su perfil ha sido actualizado correctamente.');
    }

    public function updateEmail(ValidarEmail $emails)
    {
        $query = DB::table('users')->select('email')->where('id', auth()->user()->id)->first(); 

        if(DB::table('users')->where('id', auth()->user()->id)->update(['email' => $emails['email'], 'email_verified_at' => NULL])){
            $newEmailAddress = User::get()->where('id', '=', auth()->user()->id)->first();  
            $newEmailAddress->sendEmailVerificationNotification();

            Auth::logout();

            return redirect('/')->with('mensaje', 'Se ha enviado un enlace de verificación a su nueva dirección de correo electrónico.');
        }

        
    }

    public function verificar_contrasena(Request $request)
    {
        $this->validate($request,[
            'contraseña' => 'required'
        ]);
        
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->contraseña,$hashedPassword))
        {
            return redirect()->back()->with('error_code', 5);
        }else {
            return redirect()->back()->with('error', 'La contraseña actual no coincide.');
        }

    }

    public function destroy($id)
    {
        //
    }
}
