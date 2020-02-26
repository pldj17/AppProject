<?php

use Illuminate\Database\Seeder;
use ProjectApp\Specialty;

class EspecialidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $especialidad = [
            'Electricista',
            'Albañil',
            'Plomero',
            'Soldador',
            'Carpintero',
            'Peluquero',
            'Mecanico'
        ];
        foreach($especialidad as $key => $value){
            Specialty::create([
                'name' => $value
            ]);
        }
    }
}
