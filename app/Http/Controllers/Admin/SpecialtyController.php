<?php

namespace ProjectApp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ProjectApp\Http\Controllers\Controller;
use ProjectApp\Specialty;
use Helper\AppProject;

class SpecialtyController extends Controller
{
    public function index()
    {
        can('ver-especialidad');
        $datas = Specialty::orderBy('name')->get();
        return view('admin.especialidad.index', compact('datas'));
    }

    public function create()
    {   
        can('agregar-especialidad');
        return view('admin.especialidad.index');
    }

    public function store(Request $request)
    {
        Specialty::create($request->all());
        return redirect('admin/especialidad')->with('mensaje', 'Especialidad creada con exito');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

        $data = Specialty::findOrFail($id);
        return view('admin.especialidad.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        Specialty::findOrFail($id)->update($request->all());
        return redirect('admin/especialidad')->with('mensaje', 'Especialidad actualizada con exito');
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            if (Specialty::destroy($id)) {
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
}
