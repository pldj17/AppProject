<?php

namespace ProjectApp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ProjectApp\Http\Controllers\Controller;
use ProjectApp\User;
use ProjectApp\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index')->with('users',User::paginate(5)); //pagina de usuarios
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // public function show($id){
    //     if(Auth::user()->id == $id){
    //         return redirect()->route('admin.users.index')->with('warning', 'No tienes los permisos necesarios para realizar esta acción');
            
    //     }
    //     return view('profile.index')->with(['user'=> User::find($id)]);
    // }

    public function edit($id)
    {
        if(Auth::user()->id == $id){
            return redirect()->route('admin.users.index')->with('error', 'No tienes los permisos necesarios para realizar esta acción');
            
        }
        return view('admin.users.edit')->with(['user'=> User::find($id), 'roles' => Role::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->id == $id){
            return redirect()->route('admin.users.index')->with('error', 'No tienes los permisos necesarios para realizar esta acción');
        }

        $user = User::find($id);
        $user->roles()->sync($request->roles);

        return redirect()->route('usuario')->with('mensaje','Cambio realizado con éxito'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->id == $id){
            return redirect()->route('admin.users.index')->with('error', 'No tienes los permisos necesarios para realizar esta acción');
        }

        // eliminar relacion en tabla role_user al eliminar usuario
        $user = User::find($id);

        if($user){
            $user->roles()->detach();
            $user->delete();
            return redirect()->route('admin.users.index')->with('mensaje','El usuario ha sido eliminado con éxito'); 
        }

        return redirect()->route('admin.users.index')->with('error','El usuario no puede ser eliminado'); 
    }
}
