<?php

use Illuminate\Database\Seeder;
use ProjectApp\Menu;
use ProjectApp\MenuRole;
use ProjectApp\Specialty;

class MenusTableSeeder extends Seeder
{
    
    public function run()
    {
        $Administracion = Menu::create([
            'name' => 'Administracion',
            'url' => '#'
        ]);
        $Usuario = Menu::create([
            'name' => 'Usuarios',
            'url' => 'admin/usuario',
            'icon' => 'fa-users'
        ]);
        $Especialidades = Menu::create([
            'name' => 'Especialidades',
            'url' => 'admin/especialidad',
            'icon' => 'fa-pencil-alt'
        ]);
        $Rol = Menu::create([
            'name' => 'Roles',
            'url' => 'admin/rol',
            'icon' => 'fa-user-lock'
        ]);
        $Permiso = Menu::create([
            'name' => 'Permisos',
            'url' => 'admin/permiso',
            'icon' => 'fa-user-shield'
        ]);
        $PermisoRol = Menu::create([
            'name' => 'PermisoRol',
            'url' => 'admin/permiso-rol',
            'icon' => 'fa-user-shield'
        ]);
        $Menu = Menu::create([
            'name' => 'Menus',
            'url' => 'admin/menu',
            'icon' => 'fa-bars'
        ]);
        $MenuRol = Menu::create([
            'name' => 'MenuRol',
            'url' => 'admin/menu-rol',
            'icon' => 'fa-bars'
        ]);

        MenuRole::create([
            'role_id' => 1, 
            'menu_id' => $Administracion->id
        ]);

        MenuRole::create([
            'role_id' => 1, 
            'menu_id' => $Usuario->id
        ]);

        MenuRole::create([
            'role_id' => 1, 
            'menu_id' => $Especialidades->id
        ]);

        MenuRole::create([
            'role_id' => 1, 
            'menu_id' => $Rol->id
        ]);

        MenuRole::create([
            'role_id' => 1, 
            'menu_id' => $Permiso->id
        ]);

        MenuRole::create([
            'role_id' => 1, 
            'menu_id' => $PermisoRol->id
        ]);

        MenuRole::create([
            'role_id' => 1, 
            'menu_id' => $Menu->id
        ]);

        MenuRole::create([
            'role_id' => 1, 
            'menu_id' => $MenuRol->id
        ]);
    }
}
