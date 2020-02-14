<?php

namespace ProjectApp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ProjectApp\Http\Controllers\Controller;
use ProjectApp\Http\Requests\ValidacionRol;
use ProjectApp\role;

class RoleController extends Controller
{

    public function index(Request $request)
    {
        can('ver-rol');
        // return view('admin.role.index')->with('roles',role::paginate(4)); 

        $name = $request->get('name');

        $roles = Role::orderBy('id', 'ASC')
            ->name($name)
            ->paginate(3);
        return view('admin.role.index', compact('roles')); //pagina de usuarios

    }

    public function edit($id)
    {
        can('editar-rol');
        $data = Role::findOrFail($id);  //findOrFail si no encuentra un registro manda el 404 a diferencia de find
        return view('admin.role.edit', compact('data'));
    }

    public function create()
    {
        can('crear-rol');
        return view('admin.role.create');
    }

    public function store(ValidacionRol $request)
    {
        Role::create($request->all());
        return redirect('admin/rol')->with('mensaje', 'Rol creado con exito');
    }

    public function update(Request $request, $id)
    {
        Role::findOrFail($id)->update($request->all());
        return redirect('admin/rol')->with('mensaje', 'Rol actualizado con exito');
    }

    public function destroy(Request $request, $id)
    {
        can('eliminar-rol');
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
