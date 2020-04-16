<?php

use Illuminate\Database\Seeder;
use ProjectApp\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Permission = Permission::create([
            'name' => 'Ver listado de usuarios',
            'slug' => 'ver-listado-usuario'
        ]);

        $Permission = Permission::create([
            'name' => 'Editar usuarios',
            'slug' => 'editar-usuario'
        ]);
        $Permission = Permission::create([
            'name' => 'Editar usuarios',
            'slug' => 'editar-usuario'
        ]);
        $Permission = Permission::create([
            'name' => 'Ver listado de roles',
            'slug' => 'ver-rol'
        ]);
        $Permission = Permission::create([
            'name' => 'Editar roles',
            'slug' => 'editar-rol'
        ]);
        $Permission = Permission::create([
            'name' => 'Agregar roles',
            'slug' => 'crear-rol'
        ]);
        $Permission = Permission::create([
            'name' => 'Eliminar roles',
            'slug' => 'eliminar-rol'
        ]);
        $Permission = Permission::create([
            'name' => 'Ver listado de especialidades',
            'slug' => 'ver-especialidades'
        ]);
        $Permission = Permission::create([
            'name' => 'Agregar especialidades',
            'slug' => 'agregar-especialidades'
        ]);
        $Permission = Permission::create([
            'name' => 'Editar especialidades',
            'slug' => 'editar-especialidades'
        ]);
        $Permission = Permission::create([
            'name' => 'Eliminar especialidades',
            'slug' => 'eliminar-especialidades'
        ]);
        $Permission = Permission::create([
            'name' => 'Ver permisos',
            'slug' => 'ver-permiso'
        ]);
        $Permission = Permission::create([
            'name' => 'Crear permisos',
            'slug' => 'crear-permiso'
        ]);
        $Permission = Permission::create([
            'name' => 'Editar permisos',
            'slug' => 'editar-permiso'
        ]);
        $Permission = Permission::create([
            'name' => 'Eliminar permisos',
            'slug' => 'eliminar-permiso'
        ]);
        $Permission = Permission::create([
            'name' => 'Ver listado de permisos por roles',
            'slug' => 'ver-permiso-rol'
        ]);
        $Permission = Permission::create([
            'name' => 'Ver Menus',
            'slug' => 'ver-menu'
        ]);
        $Permission = Permission::create([
            'name' => 'Crear menu',
            'slug' => 'crear-menu'
        ]);
        $Permission = Permission::create([
            'name' => 'Editar menu',
            'slug' => 'editar-menu'
        ]);
        $Permission = Permission::create([
            'name' => 'Eliminar menu',
            'slug' => 'eliminar-menu'
        ]);
        $Permission = Permission::create([
            'name' => 'Administrar menus',
            'slug' => 'administrar-menu'
        ]);
    }
}
