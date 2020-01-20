<?php

use Illuminate\Database\Seeder;
use ProjectApp\Menu;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Administracion = Menu::create([
            'name' => 'Administracion',
            'url' => '#'
        ]);
        $Usuario = Menu::create([
            'name' => 'Usuario',
            'url' => 'admin/usuario'
        ]);
        $Rol = Menu::create([
            'name' => 'Roles',
            'url' => 'admin/rol'
        ]);
        $Permiso = Menu::create([
            'name' => 'Permisos',
            'url' => 'admin/Permiso'
        ]);

        $Menu = Menu::create([
            'name' => 'Menus',
            'url' => 'admin/menu'
        ]);
        $MenuRol = Menu::create([
            'name' => 'MenuRol',
            'url' => 'admin/menu-rol'
        ]);
    }
}
