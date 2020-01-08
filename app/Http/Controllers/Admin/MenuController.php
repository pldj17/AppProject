<?php

namespace ProjectApp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ProjectApp\Http\Controllers\Controller;
use ProjectApp\Menu;
use ProjectApp\Http\Requests\ValidacionMenu;

class MenuController extends Controller
{

    public function index()
    {
        
    }

    public function create()
    {
        return view('admin.menu.create');
    }

    public function store(ValidacionMenu $request)
    {
        Menu::create($request->all());
        return redirect('admin/menu/create')->with('mensaje', 'Menú creado con exito');
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
    
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}
