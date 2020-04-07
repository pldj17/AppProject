<?php

namespace ProjectApp\Http\Controllers\Admin;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use ProjectApp\Http\Controllers\Controller;
use ProjectApp\User;
use ProjectApp\Role;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use ProjectApp\Exports\UsersExport;
use ProjectApp\Profile;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->get('name');
        can('ver-listado-usuario');
        $users = User::orderBy('id', 'ASC')
            ->name($name)
            ->paginate(6);
        $perfil = Profile::get();
        // dd($perfil);
        return view('admin.users.index', compact('users', 'perfil')); //pagina de usuarios
    }
    
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
    
    public function report()
    {
        $users = User::orderBy('id', 'ASC')->get();
        $pdf = PDF::loadView('reports/users', compact('users'));
        return $pdf->stream();
    }

    public function reportExcel()
    {
        return (new UsersExport)->download('users.xlsx');
    }

    public function reportCvs()
    {
        return (new UsersExport)->download('users.csv');
    }
}