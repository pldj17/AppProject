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
    public function index($id, Request $request)
    {
        $photo = Photo::with('post')->orderBy('id','desc')->get()->where('user_id', $id)->groupBy('post_id');

        $perfil = Profile::all()->where('user_id', $id)->first();
        $user = User::find($id);

        return view('profile.index', compact('perfil', 'user', 'photo'));
    }

    public function create()
    {
        // $especialidad = Specialty::all()->pluck('name', 'id');
        // return view('profile.edit', compact('especialidad'));
    }

    public function store(ValidarPerfil $request)
    {
        $user_id = auth()->user()->id; 

        // $perfil_primary = Profile::all()->where('user_id', auth()->user()->id);
        // $perfil_id = $perfil_primary->last();
        // $perfilll = $perfil_id->id;
    
        $perfil_id = Profile::where('user_id', $user_id)->get('id');


        // dd($perfilll);
        // $perfil= new profile();
        // $perfil->phone = $request->phone;
        // $perfil->address= $request->address;
        // $perfil->description = $request->description;
        // $perfil->correo = $request->correo;
        // $perfil->user_id = auth()->user()->id;

        // $perfil->save();
        
        Profile::where('user_id', $user_id)->update([
            
            'phone' => request('phone'),
            'address' => request('address'),
            'description' => request('description'),
            'correo' => request('correo')
        ]);

        // $perfil_id = profile::get('id')->where('user_id', auth()->user()->id);

        $Perfil_especialidades = $request->especialidades;

        foreach($Perfil_especialidades as $perfil_especialidad)
        {
            $obj = new profile_specialties();
            foreach($perfil_id as $id){
                $obj->profile_id = $id->id;
            }
            $obj->specialty_id = $perfil_especialidad;
            $obj->save();
        }   
        
        // dd($especialidad);



       // dd($request);
        // $profile_id = Profile::all()->where('user_id', Auth::id());
        // dd($profile_id);

        // $Perfil_especialidad = Profile::create($request->all());
        
        // $Perfil_especialidad->especialidades()->sync($request->input('especialidad', []));

        // $user_id = auth()->user()->id; 
        // Profile::where('user_id', $user_id)->update([
            
        //     'phone' => request('phone'),
        //     'address' => request('address'),
        //     'description' => request('description'),
        //     'correo' => request('correo')
        // ]);


         return redirect()->back()->with('mensaje', 'Su perfil ha sido actualizado correctamente');
    }

    public function show($id)
    {
        
    }

    public function edit($id, Profile $perfil)
    {
        // cargar modelo perfil en argumento
        $perfil->load('especialidades');

        $especialidades = Specialty::all()->pluck('name', 'id');
        return view('profile.edit', compact('especialidades', 'perfil'));
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

    public function destroy($id)
    {
        //
    }

}
