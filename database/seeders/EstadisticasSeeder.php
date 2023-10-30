<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EstadisticasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $date = Carbon::now()->setTimezone('America/Mexico_City');          
        DB::table('estadisticas')->insert([
            'mes'=> 'TODOS',
            'titulados' => 2,
            'created_at' => $date,
            'updated_at' => $date, 
        ]);
       
    }
}
