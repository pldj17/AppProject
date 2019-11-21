<?php

use Illuminate\Database\Seeder;
// use ProjectApp\RoleTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);

        // $this->call(UsersTableSeeder::class);
    }
}
