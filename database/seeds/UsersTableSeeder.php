<?php

use Illuminate\Database\Seeder;
use ProjectApp\User;
use ProjectApp\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        User::truncate();
        DB::table('role_user')->truncate();

        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

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

        $admin->roles()->attach($adminRole);
        $user->roles()->attach($userRole);

        factory(ProjectApp\User::class, 5)->create(); //crear usuarios automaticos

    }
}
