<?php

namespace ProjectApp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ProjectApp\Http\Controllers\Controller;
use ProjectApp\role;
use ProjectApp\Menu;

class MenuRolController extends Controller
{
    public function index()
    {
        $rols = Role::orderBy('id')->pluck('name', 'id')->toArray();
        $menus = Menu::getMenu();
        //se pide que se traiga los menus con sus respectivos roles
        $menusRols = Menu::with('roles')->get()->pluck('roles', 'id')->toArray();
        return view('admin.menu-rol.index', compact('rols', 'menus', 'menusRols'));
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $menus = new Menu();
            if ($request->input('estado') == 1) {
                $menus->find($request->input('menu_id'))->roles()->attach($request->input('rol_id'));
                return response()->json(['respuesta' => 'El rol se asigno correctamente']);
                
            } else {
                $menus->find($request->input('menu_id'))->roles()->detach($request->input('rol_id'));
                return response()->json(['respuesta' => 'El rol se elimino correctamente']);
            }
            
        } else {
            abort(404);
        }
    }
}
