<?php

namespace ProjectApp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ProjectApp\Http\Controllers\Controller;
use ProjectApp\role;
use ProjectApp\user;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{

    public function index()
    {
        return view('admin.role.index')->with('roles',Role::paginate(5));
    }

    public function edit($id)
    {
        if(Auth::user()->id == $id){
            return redirect()->route('admin.role.index')->with('warning', 'No tienes los permisos necesarios para realizar esta acción');
            
        }
        return view('admin.role.edit')->with(['role'=> Role::find($id), 'user' => User::all()]);
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function show()
    {
        
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => 'required',
        ], [
            'name.required' => 'El campo nombre es obligatorio'
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return redirect()->route('role.index');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        if(Auth::user()->id == $id){
            return redirect()->route('admin.role.index')->with('warning', 'No tienes los permisos necesarios para realizar esta acción');
        }

        // eliminar relacion en tabla role_user al eliminar usuario
        $role = Role::find($id);

        $role->delete();
        return redirect()->route('admin.role.index')->with('success','El usuario ha sido eliminado con éxito'); 
    }
}
