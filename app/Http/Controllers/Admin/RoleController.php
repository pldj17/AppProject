<?php

namespace ProjectApp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ProjectApp\Http\Controllers\Controller;
use ProjectApp\Http\Requests\ValidacionRol;
use ProjectApp\role;

class RoleController extends Controller
{

    public function index()
    {
        return view('admin.role.index')->with('roles',role::paginate(4)); 

        // $datas = Role::orderBy('id')->get();
        // return view('admin.role.index', compact('datas'));

    }

    public function edit($id)
    {
        $data = Role::findOrFail($id);  //findOrFail si no encuentra un registro manda el 404 a diferencia de find
        return view('admin.role.edit', compact('data'));
    }

    public function create()
    {
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
