<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use ProjectApp\Comment;
use ProjectApp\Http\Requests\ValidarPerfil;
use ProjectApp\Http\Requests\ValidationPassword;
use ProjectApp\Post;
use ProjectApp\Profile;
use ProjectApp\profile_specialties;
use ProjectApp\Specialty;
use ProjectApp\User;
use ProjectApp\Profile as favorite;

class ProfileController extends Controller
{
    protected $user_id;
    
    public function index($id)
    {
        // $count_comments = Comment::where('post_id', $comment)->get()->count();

        $especialidad_usuario = profile_specialties::where('user_id', $id)->get();

        $post = Post::with('photos')->orderBy('id', 'desc')->where('user_id', $id)->get();

        $posts = Post::count();

        $perfil = Profile::all()->where('user_id', $id)->first();
        $user = User::with('especialidades')->find($id);

        $post_id = Post::where('user_id', $id)->get('id');

        $comments = Comment::whereIn('post_id', $post_id)->get();
        
        $count = Comment::orderBy('id', 'desc')->get()->groupBy('post_id');

        $contador = '';
        // dd($count);

        return view('profile.index', compact('perfil', 'user', 'post', 'especialidad_usuario', 'posts', 'comments', 'count', 'contador'));
    }

    public function store(ValidarPerfil $request, User $user)
    {
        $user_id = auth()->user()->id; 

        $perfil_id = Profile::where('user_id', $user_id)->get('id');
        
        Profile::where('user_id', $user_id)->update([
            
            'phone' => request('phone'),
            // 'address' => request('address'),
            'description' => request('description'),
            'correo' => request('correo'),
            'address_address' => request('address_address')
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

    public function password(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password,$hashedPassword))
        {
            if (!Hash::check($request->password,$hashedPassword))
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                // Toastr::success('Contraseña cambiada correctamente','Success');
                Auth::logout();
                return redirect()->back();
            } else {
                return redirect()->back()->with('error', 'La nueva contraseña no puede ser la misma que la contraseña anterior');
            }
        } else {
            return redirect()->back()->with('error', 'La contraseña actual no coincide.');
        }

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
