<?php

namespace ProjectApp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ProjectApp\Http\Controllers\Controller;
use ProjectApp\Permission;
use ProjectApp\Role;

class PermissionRoleController extends Controller
{
    
    public function index()
    {
        $rols = Role::orderBy('id')->pluck('name', 'id')->toArray();
        $permisos = Permission::get();
        $permisosRols = Permission::with('roles')->get()->pluck('roles', 'id')->toArray();
        return view('admin.permiso-rol.index', compact('rols', 'permisos', 'permisosRols'));
    }

   
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $permisos = new Permission();
            if ($request->input('estado') == 1) {
                $permisos->find($request->input('permission_id'))->roles()->attach($request->input('role_id'));
                return response()->json(['respuesta' => 'El rol se asigno correctamente']);
            } else {
                $permisos->find($request->input('permission_id'))->roles()->detach($request->input('role_id'));
                return response()->json(['respuesta' => 'El rol se elimino correctamente']);
            }
        } else {
            abort(404);
        }
    }

    
}
