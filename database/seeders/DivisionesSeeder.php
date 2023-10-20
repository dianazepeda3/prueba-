<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MaestrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->setTimezone('America/Mexico_City');
        $user_id = DB::table('users')->insertGetId([
            'name' => 'Oscar Blanco Alonso',            
            'codigo' => '000000001',            
            'password' => bcrypt('Universidad2023*'),
            'is_admin' => true,           
            'created_at' => $date,
            'updated_at' => $date, 
            'admin_type' => 1, 
        ]);
        DB::table('maestros')->insert([
            'nombre' => 'Oscar Blanco Alonso',
            'email' => 'divtic@cucei.udg.mx',
            'codigo' => '123987220',
            'grado' => 'Doctorado',
            'genero' => 'M',
            'is_director_division' => 1,     
            'user_id' => $user_id,        
        ]);
        
        $user_id = DB::table('users')->insertGetId([
            'name' => 'Eduardo Mendez Palos',            
            'codigo' => '123987221',            
            'password' => bcrypt('Universidad2023*'),
            'is_teacher' => true,           
            'created_at' => $date,
            'updated_at' => $date, 
        ]);
        DB::table('maestros')->insert([
            'nombre' => 'Eduardo Mendez Palos',
            'email' => 'sdivtic@cucei.udg.mx',
            'codigo' => '123987221',
            'grado' => 'Maestría',
            'genero' => 'H',
            'is_secretario_division' => 1,  
            'user_id' => $user_id,              
        ]);
        
        $user_id = DB::table('users')->insertGetId([
            'name' => 'Nombre Presidente',            
            'codigo' => '123987200',            
            'password' => bcrypt('Universidad2023*'),
            'is_teacher' => true,           
            'created_at' => $date,
            'updated_at' => $date, 
        ]);
        DB::table('maestros')->insert([
            'nombre' => 'Nombre Presidente',
            'email' => 'presidente@cucei.udg.mx',
            'codigo' => '123987200',
            'grado' => 'Maestría',
            'genero' => 'H',
            'user_id' => $user_id,              
        ]);

        $user_id = DB::table('users')->insertGetId([
            'name' => 'Nombre Secretario',            
            'codigo' => '123987201',            
            'password' => bcrypt('Universidad2023*'),
            'is_teacher' => true,           
            'created_at' => $date,
            'updated_at' => $date, 
        ]);
        DB::table('maestros')->insert([
            'nombre' => 'Nombre Secretario',
            'email' => 'secretario@cucei.udg.mx',
            'codigo' => '123987201',
            'grado' => 'Maestría',
            'genero' => 'H',
            'user_id' => $user_id,              
        ]);

        $user_id = DB::table('users')->insertGetId([
            'name' => 'Nombre Vocal',            
            'codigo' => '123987202',            
            'password' => bcrypt('Universidad2023*'),
            'is_teacher' => true,           
            'created_at' => $date,
            'updated_at' => $date, 
        ]);
        DB::table('maestros')->insert([
            'nombre' => 'Nombre Vocal',
            'email' => 'vocal@cucei.udg.mx',
            'codigo' => '123987202',
            'grado' => 'Maestría',
            'genero' => 'H',
            'user_id' => $user_id,              
        ]);
    }
}
