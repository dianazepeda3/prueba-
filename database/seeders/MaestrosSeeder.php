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
       
        // DIVCB
        $user_id = DB::table('users')->insertGetId([
            'name' => 'Oscar Blanco Alonso',            
            'codigo' => 'divcb@cucei.udg.mx',            
            'password' => bcrypt('Universidad2023*'),
            'is_teacher' => true,           
            'created_at' => $date,
            'updated_at' => $date, 
        ]);
        DB::table('maestros')->insert([
            'nombre' => 'Oscar Blanco Alonso',
            'email' => 'divcb@cucei.udg.mx',
            'codigo' => '000000001',
            'grado' => 'Doctorado',
            'genero' => 'H',
            //'is_director_division' => 1,     
            'user_id' => $user_id,        
        ]);
        $user_id = DB::table('users')->insertGetId([
            'name' => 'Patricia del Rosario Retamoza Vega',            
            'codigo' => 'sdivcb@cucei.udg.mx',            
            'password' => bcrypt('Universidad2023*'),
            'is_teacher' => true,           
            'created_at' => $date,
            'updated_at' => $date, 
        ]);
        DB::table('maestros')->insert([
            'nombre' => 'Patricia del Rosario Retamoza Vega',
            'email' => 'sdivcb@cucei.udg.mx',
            'codigo' => '000000002',
            'grado' => 'Maestría',
            'genero' => 'M',
            //'is_secretario_division' => 1,  
            'user_id' => $user_id,              
        ]);

        //DIVING
        $user_id = DB::table('users')->insertGetId([
            'name' => 'Cesar Octavio Monzón',            
            'codigo' => 'diving@cucei.udg.mx',            
            'password' => bcrypt('Universidad2023*'),
            'is_teacher' => true,           
            'created_at' => $date,
            'updated_at' => $date, 
        ]);
        DB::table('maestros')->insert([
            'nombre' => 'Cesar Octavio Monzón',
            'email' => 'diving@cucei.udg.mx',
            'codigo' => '000000003',
            'grado' => 'Doctorado',
            'genero' => 'H',
            //'is_director_division' => 1,     
            'user_id' => $user_id,        
        ]);
        $user_id = DB::table('users')->insertGetId([
            'name' => 'Sergio Fernando Limones Pimentel',            
            'codigo' => 'sdiving@cucei.udg.mx',            
            'password' => bcrypt('Universidad2023*'),
            'is_teacher' => true,           
            'created_at' => $date,
            'updated_at' => $date, 
        ]);
        DB::table('maestros')->insert([
            'nombre' => 'Sergio Fernando Limones Pimentel',
            'email' => 'sdiving@cucei.udg.mx',
            'codigo' => '000000004',
            'grado' => 'Maestría',
            'genero' => 'M',
            //'is_secretario_division' => 1,  
            'user_id' => $user_id,              
        ]);

        // DIVTIC
        $user_id = DB::table('users')->insertGetId([
            'name' => 'Alma Yolanda Alanís García',            
            'codigo' => 'divtic@cucei.udg.mx',            
            'password' => bcrypt('Universidad2023*'),
            'is_teacher' => true,           
            'created_at' => $date,
            'updated_at' => $date, 
        ]);
        DB::table('maestros')->insert([
            'nombre' => 'Alma Yolanda Alanís García',
            'email' => 'divtic@cucei.udg.mx',
            'codigo' => '000000005',
            'grado' => 'Doctorado',
            'genero' => 'M',
            //'is_director_division' => 1,     
            'user_id' => $user_id,        
        ]);
        $user_id = DB::table('users')->insertGetId([
            'name' => 'Eduardo Mendez Palos',            
            'codigo' => 'sdivtic@cucei.udg.mx',            
            'password' => bcrypt('Universidad2023*'),
            'is_teacher' => true,           
            'created_at' => $date,
            'updated_at' => $date, 
        ]);
        DB::table('maestros')->insert([
            'nombre' => 'Eduardo Mendez Palos',
            'email' => 'sdivtic@cucei.udg.mx',
            'codigo' => '000000006',
            'grado' => 'Maestría',
            'genero' => 'H',
            //'is_secretario_division' => 1,  
            'user_id' => $user_id,              
        ]);

        // COORDINADORES
        $user_id = DB::table('users')->insertGetId([
            'name' => ' José Luis David Bonilla Carranza',            
            'codigo' => 'cdcomp@cucei.udg.mx',            
            'password' => bcrypt('Universidad2023*'),
            'is_teacher' => true,           
            'created_at' => $date,
            'updated_at' => $date, 
        ]);
        DB::table('maestros')->insert([
            'nombre' => 'José Luis David Bonilla Carranza',
            'email' => 'cdcomp@cucei.udg.mx',
            'codigo' => '000000007',
            'grado' => 'Maestría',
            'genero' => 'H',            
            'user_id' => $user_id,              
        ]);
        $user_id = DB::table('users')->insertGetId([
            'name' => ' Moisés Gilberto Pérez Martínez',            
            'codigo' => 'cdcelc@cucei.udg.mx',            
            'password' => bcrypt('Universidad2023*'),
            'is_teacher' => true,           
            'created_at' => $date,
            'updated_at' => $date, 
        ]);
        DB::table('maestros')->insert([
            'nombre' => 'Moisés Gilberto Pérez Martínez',
            'email' => 'cdcelc@cucei.udg.mx',
            'codigo' => '000000008',
            'grado' => 'Maestría',
            'genero' => 'H',            
            'user_id' => $user_id,              
        ]);

        //EJEMPLOS
        
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
