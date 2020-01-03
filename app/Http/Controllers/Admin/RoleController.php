<?php

namespace ProjectApp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ProjectApp\Http\Controllers\Controller;
use ProjectApp\role;
use ProjectApp\user;
use Illuminate\Support\Facades\Auth;
use DB;

class RoleController extends Controller
{

    public function index(Request $request)
    {

        if($request){
            
            $sql=trim($request->get('buscarTexto'));
            $roles=DB::table('roles')->where('name','LIKE','%'.$sql.'%')
            ->orderBy('id','desc')
            ->paginate(3);

            return view('admin.role.index',["roles"=>$roles,"buscarTexto"=>$sql]);
        }

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

    public function store(Request $request)
    {
        $roles= new Role();
        $roles->name= $request->name;
        $roles->description= $request->description;
        $roles->save();
        return Redirect::to("roles");

        // $data = request()->validate([
        //     'name' => 'required',
        //     'email' => ['required', 'email', 'unique:users,email'],
        //     'password' => 'required',
        // ], [
        //     'name.required' => 'El campo nombre es obligatorio'
        // ]);

        // User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => bcrypt($data['password'])
        // ]);

        // return redirect()->route('role.index');
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
