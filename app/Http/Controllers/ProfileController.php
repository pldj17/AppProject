<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use ProjectApp\Http\Requests\ValidarPerfil;
use ProjectApp\Photo;
use ProjectApp\Profile;
use ProjectApp\profile_specialties;
use ProjectApp\Specialty;
use ProjectApp\User;

class ProfileController extends Controller
{
    public function index($id, user $user)
    {
        // $especialidad_usuario = profile_specialties::where('user_id', $id)->get();

        $photo = Photo::with('post')->orderBy('id','desc')->get()->where('user_id', $id)->groupBy('post_id');

        $perfil = Profile::all()->where('user_id', $id)->first();
        $user = User::with('especialidades')->find($id);

        // dd($id);

        return view('profile.index', compact('perfil', 'user', 'photo'));
    }

    public function create()
    {
        //
    }

    public function store(ValidarPerfil $request, User $user)
    {
        // dd($user);

        $user_id = auth()->user()->id; 

        $perfil_id = Profile::where('user_id', $user_id)->get('id');
        
        Profile::where('user_id', $user_id)->update([
            
            'phone' => request('phone'),
            'address' => request('address'),
            'description' => request('description'),
            'correo' => request('correo')
        ]);

        $user->especialidades()->sync($request->input('especialidades', []), $request->input('user_id'));
        // $user->especialidades()->sync($request->input('especialidades', []));

        // $Perfil_especialidades = $request->especialidades;

        // foreach($Perfil_especialidades as $perfil_especialidad)
        // {
        //     $obj = new profile_specialties();
           
        //     $obj->specialty_id = $perfil_especialidad;
        //     $obj->user_id = Auth()->user()->id;
        //     $obj->save();
        // }   

         return redirect()->back()->with('mensaje', 'Su perfil ha sido actualizado correctamente');
    }

    public function show($id)
    {
        //
    }

    public function edit(user $user)
    {
        //  $perfil = Profile::with('especialidades')->where('user_id', $id)->get()->toArray();    
        // $perfil->load('especialidades');
        // $profiles = Profile::with('especialidades')->get();

        // $perfil = Profile::all()->where('user_id', $id);    
         
        // $perfil->load('especialidades');
        //  dd($id);

        

        $especialidades = Specialty::orderBy('name')->pluck('name', 'id');

        $user->load('especialidades');

        // dd($user, $especialidades);

        return view('profile.edit',compact('especialidades', 'user'));
    }

    public function update(Request $request, $id)
    {
        return view('profile.ajustes');

        auth()->user()->update($request->all());
        

        return back()->with('mensaje', 'Su perfil ha sido actualizado correctamente.');
    }

    public function password(Request $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->with('mensaje', 'Su perfil ha sido actualizado correctamente.');
    }

    public function AvatarUpload(Request $request)
    {
        $status = "";
        
        $this->validate($request, [
            'avatar' => 'required|mimes:png,jpeg,jpg'
        ]);

        $user_id = auth()->user()->id;


        if($request->hasfile('avatar'))
        {
            $image = $request->file('avatar');
            $ext = $image->guessExtension();
            $filename = time().'.'.$ext;

            $path = $request->file('avatar')->storeAs(
                'profile_pictures', $filename
            );

            $status = "uploaded"; 

            Profile::where('user_id', $user_id)->update([
                'avatar' => $filename
            ]);

        }        
        
        return response($status,200);
        // return redirect()->back()->with('message', 'Su foto de perfil ha sido actualizado!');
    }

    // public function destroy(Request $request, $id)
    // {
    //     if ($request->ajax()) {
    //         if (Profile::destroy($id)) {
    //             return response()->json(['mensaje' => 'ok']);
    //         } else {
    //             return response()->json(['mensaje' => 'ng']);
    //         }
    //     } else {
    //         abort(404);
    //     }
    //     return redirect()->route('profile.index');
    // }

}
