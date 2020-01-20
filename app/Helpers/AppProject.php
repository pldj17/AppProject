<?php

use ProjectApp\Permission;
use Illuminate\Database\Eloquent\Builder;

if (!function_exists('getMenuActivo')) {
    function getMenuActivo($ruta)
    {
        if (request()->is($ruta) || request()->is($ruta . '/*')) {
            return 'collapse show';
        } else {
            return '';
        }
    }
}


if (!function_exists('canUser')) {
    function can($permiso, $redirect = true)
    {
        if (session()->get('rol_nombre') == 'admin') {
            return true;
        } else {
            $rolId = session()->get('rol_id');
            $permisos = session()->get("$rolId", function(){
                return Permission::whereHas('roles', function ($query)
                {
                    $query->where('role_id', session()->get('rol_id'));
                })->get()->pluck('slug')->toArray();
            });
            if (!in_array($permiso, $permisos)) {
                if ($redirect) {
                    if (!request()->ajax())
                        return redirect()->route('home')->with('mensaje', 'No tienes permisos para acceder a esta sección')->send();
                    abort(403, 'No tiene permiso');
                } else {
                    return false;
                }
            }
            return true;
        }
    }
}
