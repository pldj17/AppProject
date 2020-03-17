<?php

use Illuminate\Database\Seeder;
use ProjectApp\MenuRole;

class MenuAdminTableSeeder extends Seeder
{
    public function run()
    {
        $a = MenuRole::create([
            'role_id' => '1',
            'menu_id' => '1'
        ]);
        $b = MenuRole::create([
            'role_id' => '1',
            'menu_id' => '2'
        ]);
        $c = MenuRole::create([
            'role_id' => '1',
            'menu_id' => '3'
        ]);
        $d = MenuRole::create([
            'role_id' => '1',
            'menu_id' => '4'
        ]);
        $e = MenuRole::create([
            'role_id' => '1',
            'menu_id' => '5'
        ]);
        $e = MenuRole::create([
            'role_id' => '1',
            'menu_id' => '6'
        ]);
        $f = MenuRole::create([
            'role_id' => '1',
            'menu_id' => '7'
        ]);
        $g = MenuRole::create([
            'role_id' => '1',
            'menu_id' => '8'
        ]);
    }
}
