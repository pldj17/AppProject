<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use ProjectApp\Specialty;
use Helper\AppProject;

class SpecialtyController extends Controller
{
    public function index()
    {
        can('ver-listado-de-especialidad');
        $datas = Specialty::orderBy('id')->get();
        return view('specialty.index', compact('datas'));
    }

    public function create()
    {   
        can('agregar-especialidad');
        return view('specialty.create');
    }

    public function store(Request $request)
    {
        Specialty::create($request->all());
        return redirect('especialidad')->with('mensaje', 'Especialidad creada con exito');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

        $data = Specialty::findOrFail($id);
        return view('specialty.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        Specialty::findOrFail($id)->update($request->all());
        return redirect('especialidad')->with('mensaje', 'Especialidad actualizada con exito');
    }

    public function destroy($id)
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
