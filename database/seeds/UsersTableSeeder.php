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

        $admin->roles()->sync(1);
        $user->roles()->sync(2);

        // DB::table('role_user')->insert([
        //     'role_id' => 1,
        //     'user_id' => 1,
        //     'state' => 1
        // ]);

        // DB::table('role_user')->insert([
        //     'role_id' => 2,
        //     'user_id' => 2,
        //     'state' => 1
        // ]);
       
       
        // User::truncate();
        // DB::table('role_user')->truncate();

        // $adminRole = Role::where('name', 'admin')->first();
        // $userRole = Role::where('name', 'user')->first();

        // $admin = User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@admin.com',
        //     'password' => bcrypt('123456789')
        // ]);

        // $user = User::create([
        //     'name' => 'user',
        //     'email' => 'user@user.com',
        //     'password' => bcrypt('123456789')
        // ]);

        // $admin->roles()->attach($adminRole);
        // $user->roles()->attach($userRole);

        // factory(ProjectApp\User::class, 5)->create(); //crear usuarios automaticos

    }
}
