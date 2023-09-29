<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TramitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tramites')->insert([
            'estado'=> 2,
            'alumno_id'=> 1
        ]);
        DB::table('tramites')->insert([
            'estado'=> 2,
            'alumno_id'=> 2
        ]);
        DB::table('tramites')->insert([
            'estado'=> 2,
            'alumno_id'=> 3
        ]);
    }
}
