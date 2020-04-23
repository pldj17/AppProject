<?php

use Illuminate\Database\Seeder;
use ProjectApp\Profile;
use ProjectApp\User;
use ProjectApp\Role;

class UsersTableSeeder extends Seeder
{

    public function run()
    {

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456789')
        ]);

        $user = User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => bcrypt('123456789')
        ]);

        Profile::create([
            'user_id' => $admin->id, 
            'private' => 0
        ]);

        Profile::create([
            'user_id' => $user->id, 
            'private' => 0
        ]);

        $admin->roles()->sync(1);
        $user->roles()->sync(2);

    }
}
