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
        $this->truncateTablas([
            'roles',
            'users',
            'role_user'
        ]);

        $this->call(EspecialidadesTableSeeder::class);

        $this->call(RolesTableSeeder::class);

        $this->call(UsersTableSeeder::class);
        
        $this->call(MenusTableSeeder::class);
    }

    protected function truncateTablas(array $tablas)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        foreach ($tablas as $tabla) {
            DB::table($tabla)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }

}
