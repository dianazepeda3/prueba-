<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->setTimezone('America/Mexico_City');
        DB::table('users')->insert([
            'name' => 'admin',
            'codigo' => 'admin@gmail.com',//'987654321',
            'password' => bcrypt('Universidad2023*'),
            'is_admin' => true,           
            'created_at' => $date,
            'updated_at' => $date, 
            'admin_type' => 1,
        ]);
        // Alumno 1
        DB::table('users')->insert([
            'name' => 'Kallie Kilback MD',
            'codigo' => '554036093',
            'password' => bcrypt('Universidad2023*'),            
            'created_at' => $date,
            'updated_at' => $date,          
        ]);
        DB::table('alumnos')->insert([
            'user_id' => 2,    
            'fecha_nacimiento' => '1997-08-12',
            'genero' => 'Mujer',
            'estado_civil' => 'Soltero',
            'telefono_celular' => '3312812731',
            'telefono_particular' => '2134873444',
            'estado_nacimiento' => 'Jalisco', 
            'municipio_nacimiento' => 'Guadalajara',
            'dom_calle' => 'Nombre Calle',  
            'dom_numero' => 12,
            'dom_colonia' => 'Nombre Colonia',  
            'dom_CP' => '45893',   
            'dom_municipio' => 'Guadalajara',  
            'dom_estado' => 'Jalisco',  
            'correo_institucional' => 'kallie@alumnos.udg.mx',
            'correo_part' => 'kallie@gmail.com',
            
            'id_carrera' => 5, //INCO
            'id_plan_estudios' => 2,
            'id_articulo' => 3,
            'id_opcion_titulacion' => 7,
            'promedio' => 87,
            'ciclo_ingreso' => '2017A',
            'ciclo_egreso' => '2022B',
        ]);
        DB::table('tramites')->insert([
            'estado'=> 2,
            'alumno_id'=> 1,
        ]);
        DB::table('alumno_docs')->insert([
            'alumno_id' => 1,
        ]);

        // Alumno 2
        DB::table('users')->insert([
            'name' => 'Saharai Vargas',
            'codigo' => '828693083',
            'password' => bcrypt('Universidad2023*'),            
            'created_at' => $date,
            'updated_at' => $date,          
        ]);
        DB::table('alumnos')->insert([
            'user_id' => 3,    
            'fecha_nacimiento' => '1995-02-14',
            'genero' => 'Mujer',
            'estado_civil' => 'Soltero',
            'telefono_celular' => '5467386487',
            'telefono_particular' => '3134873344',
            'estado_nacimiento' => 'Jalisco', 
            'municipio_nacimiento' => 'Guadalajara',
            'dom_calle' => 'Nombre Calle',  
            'dom_numero' => 12,
            'dom_colonia' => 'Nombre Colonia',  
            'dom_CP' => '45893',   
            'dom_municipio' => 'Guadalajara',  
            'dom_estado' => 'Jalisco',  
            'correo_institucional' => 'saharai@alumnos.udg.mx',
            'correo_part' => 'saharai@gmail.com',
            
            'id_carrera' => 3, //INFO
            'id_plan_estudios' => 2,
            'id_articulo' => 2,
            'id_opcion_titulacion' => 5,
            'promedio' => 89,
            'ciclo_ingreso' => '2017A',
            'ciclo_egreso' => '2022B',
        ]);
        DB::table('tramites')->insert([
            'estado'=> 2,
            'alumno_id'=> 2,
        ]);
        DB::table('alumno_docs')->insert([
            'alumno_id' => 2,
        ]);

        // Alumno 3
        DB::table('users')->insert([
            'name' => 'Macarena Ferreiro',
            'codigo' => '456697802',
            'password' => bcrypt('Universidad2023*'),            
            'created_at' => $date,
            'updated_at' => $date,          
        ]);
        DB::table('alumnos')->insert([
            'user_id' => 4,    
            'fecha_nacimiento' => '1992-12-04',
            'genero' => 'Mujer',
            'estado_civil' => 'Soltero',
            'telefono_celular' => '5467386487',
            'telefono_particular' => '3134873344',
            'estado_nacimiento' => 'Jalisco', 
            'municipio_nacimiento' => 'Guadalajara',
            'dom_calle' => 'Nombre Calle',  
            'dom_numero' => 12,
            'dom_colonia' => 'Nombre Colonia',  
            'dom_CP' => '45893',   
            'dom_municipio' => 'Guadalajara',  
            'dom_estado' => 'Jalisco',  
            'correo_institucional' => 'macarena@alumnos.udg.mx',
            'correo_part' => 'macarena@gmail.com',
            
            'id_carrera' => 5, //INCO
            'id_plan_estudios' => 2,
            'id_articulo' => 1,
            'id_opcion_titulacion' => 2,
            'promedio' => 93,
            'ciclo_ingreso' => '2019A',
            'ciclo_egreso' => '2024A',
        ]);
        DB::table('tramites')->insert([
            'estado'=> 2,
            'alumno_id'=> 3,
        ]);
        DB::table('alumno_docs')->insert([
            'alumno_id' => 3,
        ]);

        // Alumno 4
        DB::table('users')->insert([
            'name' => 'Louis T',
            'codigo' => '588532805 ',
            'password' => bcrypt('Universidad2023*'),            
            'created_at' => $date,
            'updated_at' => $date,          
        ]);
        DB::table('alumnos')->insert([
            'user_id' => 5,    
            'fecha_nacimiento' => '1992-12-24',
            'genero' => 'Hombre',
            'estado_civil' => 'Casado',
            'telefono_celular' => '5467386428',
            'telefono_particular' => '3134873344',
            'estado_nacimiento' => 'Jalisco', 
            'municipio_nacimiento' => 'Guadalajara',
            'dom_calle' => 'Nombre Calle',  
            'dom_numero' => 12,
            'dom_colonia' => 'Nombre Colonia',  
            'dom_CP' => '45893',   
            'dom_municipio' => 'Guadalajara',  
            'dom_estado' => 'Jalisco',  
            'correo_institucional' => 'louis28@alumnos.udg.mx',
            'correo_part' => 'louis28@gmail.com',
            
            'id_carrera' => 5, //INCO
            'id_plan_estudios' => 2,
            'id_articulo' => 5,
            'id_opcion_titulacion' => 16,
            'promedio' => 93,
            'ciclo_ingreso' => '2019A',
            'ciclo_egreso' => '2024A',
        ]);
        DB::table('tramites')->insert([
            'estado'=> 2,
            'alumno_id'=> 4,
        ]);
        DB::table('alumno_docs')->insert([
            'alumno_id' => 4,
        ]);
        
        // Alumno 5
        DB::table('users')->insert([
            'name' => 'Abraham Zepeda',
            'codigo' => '319968300',
            'password' => bcrypt('Universidad2023*'),            
            'created_at' => $date,
            'updated_at' => $date,          
        ]);
        DB::table('alumnos')->insert([
            'user_id' => 6,    
            'fecha_nacimiento' => '2000-09-12',
            'genero' => 'Hombre',
            'estado_civil' => 'Casado',
            'telefono_celular' => '5467386428',
            'telefono_particular' => '3134873344',
            'estado_nacimiento' => 'Jalisco', 
            'municipio_nacimiento' => 'Guadalajara',
            'dom_calle' => 'Nombre Calle',  
            'dom_numero' => 12,
            'dom_colonia' => 'Nombre Colonia',  
            'dom_CP' => '45893',   
            'dom_municipio' => 'Guadalajara',  
            'dom_estado' => 'Jalisco',  
            'correo_institucional' => 'abraham@alumnos.udg.mx',
            'correo_part' => 'abraham@gmail.com',
            
            'id_carrera' => 6, //IGFO
            'id_plan_estudios' => 2,
            'id_articulo' => 5,
            'id_opcion_titulacion' => 14,
            'promedio' => 93,
            'ciclo_ingreso' => '2019A',
            'ciclo_egreso' => '2024A',
        ]);
        DB::table('tramites')->insert([
            'estado'=> 2,
            'alumno_id'=> 5,
        ]);
        DB::table('alumno_docs')->insert([
            'alumno_id' => 5,
        ]);

        // Alumno 6
        DB::table('users')->insert([
            'name' => 'Elisabet Tatengo',
            'codigo' => '533712856',
            'password' => bcrypt('Universidad2023*'),            
            'created_at' => $date,
            'updated_at' => $date,          
        ]);
        DB::table('alumnos')->insert([
            'user_id' => 7,    
            'fecha_nacimiento' => '2000-07-01',
            'genero' => 'Mujer',
            'estado_civil' => 'Soltero',
            'telefono_celular' => '3312583666',
            'telefono_particular' => '3134870987',
            'estado_nacimiento' => 'Jalisco', 
            'municipio_nacimiento' => 'Guadalajara',
            'dom_calle' => 'Nombre Calle',  
            'dom_numero' => 12,
            'dom_colonia' => 'Nombre Colonia',  
            'dom_CP' => '45893',   
            'dom_municipio' => 'Guadalajara',  
            'dom_estado' => 'Jalisco',  
            'correo_institucional' => 'elisabet@alumnos.udg.mx',
            'correo_part' => 'elisabet@gmail.com',
            
            'id_carrera' => 6, //IGFO
            'id_plan_estudios' => 2,
            'id_articulo' => 3,
            'id_opcion_titulacion' => 8,
            'promedio' => 83,
            'ciclo_ingreso' => '2019A',
            'ciclo_egreso' => '2024B',
        ]);
        DB::table('tramites')->insert([
            'estado'=> 2,
            'alumno_id'=> 6,
        ]);
        DB::table('alumno_docs')->insert([
            'alumno_id' => 6,
        ]);

        // Alumno 7
        DB::table('users')->insert([
            'name' => 'Taylor S',
            'codigo' => '676738772',
            'password' => bcrypt('Universidad2023*'),            
            'created_at' => $date,
            'updated_at' => $date,          
        ]);
        DB::table('alumnos')->insert([
            'user_id' => 8,    
            'fecha_nacimiento' => '1989-11-13',
            'genero' => 'Mujer',
            'estado_civil' => 'Soltero',
            'telefono_celular' => '3312483666',
            'telefono_particular' => '3134870987',
            'estado_nacimiento' => 'Jalisco', 
            'municipio_nacimiento' => 'Guadalajara',
            'dom_calle' => 'Nombre Calle',  
            'dom_numero' => 12,
            'dom_colonia' => 'Nombre Colonia',  
            'dom_CP' => '45893',   
            'dom_municipio' => 'Guadalajara',  
            'dom_estado' => 'Jalisco',  
            'correo_institucional' => 'taylor@alumnos.udg.mx',
            'correo_part' => 'taylor@gmail.com',
            
            'id_carrera' => 1, //INBI
            'id_plan_estudios' => 2,
            'id_articulo' => 1,
            'id_opcion_titulacion' => 1,
            'promedio' => 98,
            'ciclo_ingreso' => '2019A',
            'ciclo_egreso' => '2024B',
        ]);
        DB::table('tramites')->insert([
            'estado'=> 2,
            'alumno_id'=> 7,
        ]);
        DB::table('alumno_docs')->insert([
            'alumno_id' => 7,
        ]);

        // Alumno 8
        DB::table('users')->insert([
            'name' => 'Soledad Gutierrez',
            'codigo' => '543594161',
            'password' => bcrypt('Universidad2023*'),            
            'created_at' => $date,
            'updated_at' => $date,          
        ]);
        DB::table('alumnos')->insert([
            'user_id' => 9,    
            'fecha_nacimiento' => '1999-11-03',
            'genero' => 'Mujer',
            'estado_civil' => 'Soltero',
            'telefono_celular' => '3312483666',
            'telefono_particular' => '3134870987',
            'estado_nacimiento' => 'Jalisco', 
            'municipio_nacimiento' => 'Guadalajara',
            'dom_calle' => 'Nombre Calle',  
            'dom_numero' => 12,
            'dom_colonia' => 'Nombre Colonia',  
            'dom_CP' => '45893',   
            'dom_municipio' => 'Guadalajara',  
            'dom_estado' => 'Jalisco',  
            'correo_institucional' => 'soledad@alumnos.udg.mx',
            'correo_part' => 'soledad@gmail.com',
            
            'id_carrera' => 7, //INBI
            'id_plan_estudios' => 2,
            'id_articulo' => 4,
            'id_opcion_titulacion' => 11,
            'promedio' => 88,
            'ciclo_ingreso' => '2017A',
            'ciclo_egreso' => '2023B',
        ]);
        DB::table('tramites')->insert([
            'estado'=> 2,
            'alumno_id'=> 8,
        ]);
        DB::table('alumno_docs')->insert([
            'alumno_id' => 8,
        ]);

        // Alumno 9
        DB::table('users')->insert([
            'name' => 'Rosalia Ureña',
            'codigo' => '216667456',
            'password' => bcrypt('Universidad2023*'),            
            'created_at' => $date,
            'updated_at' => $date,          
        ]);
        DB::table('alumnos')->insert([
            'user_id' => 10,    
            'fecha_nacimiento' => '1999-11-03',
            'genero' => 'Mujer',
            'estado_civil' => 'Soltero',
            'telefono_celular' => '3312483666',
            'telefono_particular' => '3134870987',
            'estado_nacimiento' => 'Jalisco', 
            'municipio_nacimiento' => 'Guadalajara',
            'dom_calle' => 'Nombre Calle',  
            'dom_numero' => 12,
            'dom_colonia' => 'Nombre Colonia',  
            'dom_CP' => '45893',   
            'dom_municipio' => 'Guadalajara',  
            'dom_estado' => 'Jalisco',  
            'correo_institucional' => 'rosalia@alumnos.udg.mx',
            'correo_part' => 'rosalia@gmail.com',
            
            'id_carrera' => 5, //INCO
            'id_plan_estudios' => 2,
            'id_articulo' => 2,
            'id_opcion_titulacion' => 4,
            'promedio' => 88,
            'ciclo_ingreso' => '2017B',
            'ciclo_egreso' => '2023A',
        ]);
        DB::table('tramites')->insert([
            'estado'=> 2,
            'alumno_id'=> 9,
        ]);
        DB::table('alumno_docs')->insert([
            'alumno_id' => 9,
        ]);

        // Alumno 9
        DB::table('users')->insert([
            'name' => 'Ruby Rose',
            'codigo' => '216865767',
            'password' => bcrypt('Universidad2023*'),            
            'created_at' => $date,
            'updated_at' => $date,          
        ]);
        DB::table('alumnos')->insert([
            'user_id' => 11,    
            'fecha_nacimiento' => '1999-11-03',
            'genero' => 'Mujer',
            'estado_civil' => 'Soltero',
            'telefono_celular' => '3312483666',
            'telefono_particular' => '3134870987',
            'estado_nacimiento' => 'Jalisco', 
            'municipio_nacimiento' => 'Guadalajara',
            'dom_calle' => 'Nombre Calle',  
            'dom_numero' => 12,
            'dom_colonia' => 'Nombre Colonia',  
            'dom_CP' => '45893',   
            'dom_municipio' => 'Guadalajara',  
            'dom_estado' => 'Jalisco',  
            'correo_institucional' => 'ruby@alumnos.udg.mx',
            'correo_part' => 'ruby@gmail.com',
            
            'id_carrera' => 5, //INCO
            'id_plan_estudios' => 2,
            'id_articulo' => 5,
            'id_opcion_titulacion' => 14,
            'promedio' => 88,
            'ciclo_ingreso' => '2017B',
            'ciclo_egreso' => '2023A',
        ]);
        DB::table('tramites')->insert([
            'estado'=> 2,
            'alumno_id'=> 10,
        ]);
        DB::table('alumno_docs')->insert([
            'alumno_id' => 10,
        ]);

        /*DB::table('users')->insert([
            'name' => 'Informática',
            'codigo' => '123987211',
            'password' => bcrypt('Universidad2023*'),
            /*'id_carrera' => 2,
            'is_admin' => true,         
            'created_at' => $date,
            'updated_at' => $date,   
            'admin_type' => 2, 
        ]);
        DB::table('users')->insert([
            'name' => 'Electrónica',
            'codigo' => '123987212',
            'password' => bcrypt('Universidad2023*'),
            /*'id_carrera' => 4,
            'is_admin' => true,
            'created_at' => $date,
            'updated_at' => $date,     
            'admin_type' => 2,        
        ]);
        DB::table('users')->insert([
            'name' => 'Computación',
            'codigo' => '123987213',
            'password' => bcrypt('Universidad2023*'),
            /*'id_carrera' => 5,
            'is_admin' => true,   
            'created_at' => $date,
            'updated_at' => $date,          
            'admin_type' => 2,
        ]);     */   
    }
}
