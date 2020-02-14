<?php

namespace ProjectApp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ProjectApp\Http\Controllers\Controller;
use ProjectApp\Http\Requests\ValidacionMenu;
use ProjectApp\Menu;

class MenuController extends Controller
{

    public function index()
    {
        can('ver-menu');
        $menus = Menu::getMenu();
        return view('admin.menu.index', compact('menus'));
    }

    public function crear()
    {
        can('crear-menu');
        return view('admin.menu.create');
    }

    public function guardar(ValidacionMenu $request)
    {
        Menu::create($request->all());
        return redirect('admin/menu')->with('mensaje', 'Menú creado con exito');
    }

    public function editar($id)
    {
        can('editar-menu');
        $data = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('data'));
    }

    public function actualizar(ValidacionMenu $request, $id)
    {
        Menu::findOrFail($id)->update($request->all());
        return redirect('admin/menu')->with('mensaje', 'Menú actualizado con exito');
    }

    public function eliminar($id)
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
