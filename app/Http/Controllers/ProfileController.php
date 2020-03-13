<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use ProjectApp\Http\Requests\ValidarPerfil;
use ProjectApp\Http\Requests\ValidationPassword;
use ProjectApp\Photo;
use ProjectApp\Post;
use ProjectApp\Profile;
use ProjectApp\profile_specialties;
use ProjectApp\Specialty;
use ProjectApp\User;

class ProfileController extends Controller
{
    public function index($id, user $user)
    {
        $especialidad_usuario = profile_specialties::where('user_id', $id)->get();

        $photo = Post::with('photos')->orderBy('id', 'desc')->where('user_id', $id)->get();

        $posts = Post::count();

        $perfil = Profile::all()->where('user_id', $id)->first();
        $user = User::with('especialidades')->find($id);

        // dd($posts);

        return view('profile.index', compact('perfil', 'user', 'photo', 'especialidad_usuario', 'posts'));
    }

    public function config(user $user)
    {
        $id = $user->id;

        $perfil = Profile::all()->where('user_id', $id)->first();
        $user = User::with('especialidades')->find($id);

        return view('profile.config', compact('perfil', 'user'));
    }

    public function configStore(user $user)
    {
        $id = $user->id;

        Profile::where('user_id', $id)->update([
            'private' => request('private')
        ]);
        
        return redirect()->back()->with('mensaje', 'Su perfil ha sido actualizado correctamente');

    }

    public function store(ValidarPerfil $request, User $user)
    {
        $user_id = auth()->user()->id; 

        $perfil_id = Profile::where('user_id', $user_id)->get('id');
        
        Profile::where('user_id', $user_id)->update([
            
            'phone' => request('phone'),
            'address' => request('address'),
            'description' => request('description'),
            'correo' => request('correo')
        ]);

        $user->especialidades()->sync($request->input('especialidades', []), $request->input('user_id')); 


        return redirect()->back()->with('mensaje', 'Su perfil ha sido actualizado correctamente');
    }

    public function show($id)
    {
        //
    }

    public function edit(user $user, Request $request)
    {
        $id = $user->id;

        $perfil = Profile::all()->where('user_id', $id)->first();

        if(!$request->active){
            $request->merge([
                'private' => 0
            ]);
        }

        $especialidades = Specialty::orderBy('name')->pluck('name', 'id');

        $user->load('especialidades');

        // dd($user, $especialidades);

        return view('profile.edit',compact('especialidades', 'user', 'perfil'));
    }

    public function update(Request $request)
    {
        $user_id = auth()->user()->id; 

        User::where('id', $user_id)->update([
            'name' => request('name'),
            'email' => request('email'),
        ]);
        

        return back()->with('mensaje', 'Su perfil ha sido actualizado correctamente.');
    }

    public function password(ValidationPassword $request)
    {
        $user_id = auth()->user()->id; 

        User::where('id', $user_id)->update([
            'password' => Hash::make($request->get('password'))
        ]);
        

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
