<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use ProjectApp\Http\Requests\ValidarPerfil;
use ProjectApp\Photo;
use ProjectApp\Profile;
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
        $especialidad = Specialty::all()->pluck('name', 'id');
        return view('profile.edit', compact('especialidad'));
    }

    public function store(ValidarPerfil $request)
    {
        $profile_id = Profile::all()->where('user_id', Auth::id());
        // dd($profile_id);

        $Perfil_especialidad = Profile::create($request->all());
        $Perfil_especialidad->especialidades()->sync($request->input('especialidad', []));

        $user_id = auth()->user()->id; 
        Profile::where('user_id', $user_id)->update([
            
            'phone' => request('phone'),
            'address' => request('address'),
            'description' => request('description'),
            'correo' => request('correo')
        ]);

        // $Perfil_especialidad = Profile::create($request->all());
        // $profile_id->especialidades()->attach($Perfil_especialidad);

         return redirect()->back()->with('mensaje', 'Su perfil ha sido actualizado correctamente');
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
         // $profile_id = Profile::all()->where('user_id', Auth::id());
        // dd($profile_id);

        $especialidad = Specialty::all()->pluck('name', 'id');
        return view('profile.edit', compact('especialidad'));
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

    public function info()
    {
        return view('profile.info');
    }

    public function contact()
    {
        return view('profile.contact');
    }

}
