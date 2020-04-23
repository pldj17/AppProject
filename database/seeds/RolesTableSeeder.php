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
    }
}
