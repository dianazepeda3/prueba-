<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanestudiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plan_estudios')->insert(['nombre' => 'CRÉDITOS MODULAR (REALIZÓ PROYECTO MODULAR)',]);
        DB::table('plan_estudios')->insert(['nombre' => 'CRÉDITOS',]);
        DB::table('plan_estudios')->insert(['nombre' => 'RÍGIDO',]);
        DB::table('plan_estudios')->insert(['nombre' => 'INCORPORADAS',]);
        DB::table('plan_estudios')->insert(['nombre' => 'TÉCNICO SUPERIOR UNIVERSITARIO (TSU)',]);
    }
}
