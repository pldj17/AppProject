<?php

namespace ProjectApp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ProjectApp\Http\Controllers\Controller;
use ProjectApp\User;
use ProjectApp\Role;
use Illuminate\Support\Facades\Auth;

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
    
    // public function show($id){
    //     if(Auth::user()->id == $id){
    //         return redirect()->route('admin.users.index')->with('warning', 'No tienes los permisos necesarios para realizar esta acción');
            
    //     }
    //     return view('profile.index')->with(['user'=> User::find($id)]);
    // }
    public function edit($id)
    {
        can('editar-usuario');
        if(Auth::user()->id == $id){
            return redirect()->route('usuario')->with('error', 'No tienes los permisos necesarios para realizar esta acción');
            
        }
        return view('admin.users.edit')->with(['user'=> User::find($id), 'roles' => Role::all()]);
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
