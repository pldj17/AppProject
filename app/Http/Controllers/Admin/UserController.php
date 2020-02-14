<?php

namespace ProjectApp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ProjectApp\Http\Controllers\Controller;
use ProjectApp\User;
use ProjectApp\Role;
use Illuminate\Support\Facades\Auth;
use ProjectApp\Photo;
use ProjectApp\Profile;

class UserController extends Controller
{
    public function index(Request $request)
    {
        

        $name = $request->get('name');
        can('ver-listado-usuario');
        $users = User::orderBy('id', 'ASC')
            ->name($name)
            ->paginate(5);
        return view('admin.users.index', compact('users')); //pagina de usuarios
    }
    
    public function edit($id)
    {
        can('editar-usuario');
        if(Auth::user()->id == $id){
            return redirect()->route('usuario')->with('error', 'No tienes los permisos necesarios para realizar esta acción');
            
        }
        return view('admin.users.edit')->with(['user'=> User::find($id), 'roles' => Role::all()]);
    }
    
    public function show($id, User $user, Profile $perfil)
    {

        $photo = Photo::with('post')->orderBy('id','desc')->get()->where('user_id', $id)->groupBy('post_id');

        $perfil = Profile::all()->where('user_id', $id)->first();
        $user = user::find($id);

        // dd($photo);

        return view('profile.index', compact('perfil', 'user', 'photo'));
    }

    public function update(Request $request, $id)
    {
        if(Auth::user()->id == $id){
            return redirect()->route('usuario')->with('error', 'No tienes los permisos necesarios para realizar esta acción');
        }
        $user = User::find($id);
        $user->roles()->sync($request->roles);
        return redirect()->route('usuario')->with('mensaje','Cambio realizado con éxito'); 
    }
    
    public function destroy(Request $request, $id)
    {
        can('eliminar-usuario');
        if ($request->ajax()) {
            if (Role::destroy($id)) {
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
}