<?php

use Illuminate\Database\Seeder;
use ProjectApp\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $rols = [
            'admin',
            'user',
            'invitado'
        ];
        foreach($rols as $key => $value){
            Role::create([
                'name' => $value
            ]);
        }

        // Role::truncate();

        // Role::create(['name' => 'admin', 'description' => 'Rol de admin para uso de la aplicación']);

        // Role::create(['name' => 'user', 'description' => 'Rol de user para uso de la aplicación']);
    }
}
