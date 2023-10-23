<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DivisionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {                  
        DB::table('divisions')->insert([
            'nombre_division'=> 'División de Ciencias Básicas',
            'clave' => 'DIVCB',
        ]);

        DB::table('divisions')->insert([
            'nombre_division'=> 'División de Ingenierías',
            'clave' => 'DIVING',
        ]);

        DB::table('divisions')->insert([
            'nombre_division'=> 'División de Tecnologías para la Integración Ciber-Humana',
            'clave' => 'DIVTIC',
        ]);
    }
}
