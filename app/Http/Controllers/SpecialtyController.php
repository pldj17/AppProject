<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use ProjectApp\Specialty;

class SpecialtyController extends Controller
{
    public function index()
    {
        dd(session()->all());
        $datas = Specialty::orderBy('id')->get();
        return view('specialty.index', compact('datas'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
