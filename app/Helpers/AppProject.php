<?php

use ProjectApp\Permission;
use Illuminate\Database\Eloquent\Builder;

if (!function_exists('getMenuActivo')) {
    function getMenuActivo($ruta)
    {
        if (request()->is($ruta) || request()->is($ruta . '/*')) {
            return 'active';
        } else {
            return '';
        }
    }
}

//uso de cache de laravel para los permisos

// if (!function_exists('canUser')) {
//     function can($permiso, $redirect = true)
//     {
//         if (session()->get('rol_nombre') == 'administrador') {
//             return true;
//         } else {
//             $rolId = session()->get('rol_id');
//             //se pasa el tag permiso, se crea una key Permiso.rolid.rolid
//             $permisos = cache()->tags('Permiso')->rememberForever("Permiso.rolid.$rolId", function () {
//                 //en esta condicion se pide todos los permisos que tenga este rol
//                 return Permiso::whereHas('roles', function ($query) {
//                     //verifica que el rol_id sea la variable de sesion
//                     $query->where('rol_id', session()->get('rol_id'));
//                 })->get()->pluck('slug')->toArray();
//             });
//             //aqui se consulta si en la array de $permisos existe permiso, si existe se retorna true, sino
//             if (!in_array($permiso, $permisos)) {
//                 if ($redirect) {
//                     if (!request()->ajax())
//                         return redirect()->route('inicio')->with('mensaje', 'No tienes permisos para acceder a esta sección')->send();
//                     abort(403, 'No tiene permiso');
//                 } else {
//                     return false;
//                 }
//             }
//             return true;
//         }
//     }
// }
