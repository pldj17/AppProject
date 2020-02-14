<?php

namespace ProjectApp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ProjectApp\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use ProjectApp\Permission;
use ProjectApp\Http\Requests\ValidarPermiso;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        // $permisos = permission::orderBy('id')->get();
        // return view('admin.permiso.index', compact('permisos'));
        can('ver-permiso');
        $name = $request->get('name');

        $permisos = Permission::orderBy('id', 'ASC')
            ->name($name)
            ->paginate(6);
        return view('admin.permiso.index', compact('permisos')); 

        // return view('admin.permiso.index')->with('permisos', permission::paginate(4));
    }

    public function create()
    {
        can('crear-permiso');
        return view('admin.permiso.create');
    }

    public function store(ValidarPermiso $request)
    {
        Permission::create($request->all());
        return redirect('admin/permiso')->with('mensaje', 'Permiso creado con exito');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        can('editar-permiso');
        $data = Permission::findOrFail($id);
        return view('admin.permiso.edit', compact('data'));
    }

    public function update(ValidarPermiso $request, $id)
    {
        Permission::findOrFail($id)->update($request->all());
        return redirect('admin/permiso')->with('mensaje', 'Permiso actualizado con exito');
    }

    public function destroy(Request $request, $id)
    {
        can('eliminar-permiso');
        if ($request->ajax()) {
            if (Permission::destroy($id)) {
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
}
