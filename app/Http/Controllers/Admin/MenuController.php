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
        can('ver-listado-menu');
        $menus = Menu::getMenu();
        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menu.create');
    }

    public function store(ValidacionMenu $request)
    {
        can('agregar-nuevo-menu');
        Menu::create($request->all());
        return redirect('admin/menu')->with('mensaje', 'Menú creado con exito');
    }

    public function edit($id)
    {
        can('editar-menu');
        $data = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('data'));
    }

    public function update(ValidacionMenu $request, $id)
    {
        Menu::findOrFail($id)->update($request->all());
        return redirect('admin/menu')->with('mensaje', 'Menú actualizado con exito');
    }

    public function destroy($id)
    {
        can('eliminar-menu');
        Menu::destroy($id);
        return redirect('admin/menu')->with('mensaje', 'Menú eliminado con exito');
    }

    public function guardarOrden(Request $request)
    {
        if ($request->ajax()) {
            $menu = new Menu;
            $menu->guardarOrden($request->menu);
            return response()->json(['respuesta' => 'ok']);
        } else {
            abort(404);
        }
    }
}
