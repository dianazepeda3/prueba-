<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarrerasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // División de Ciencias Básicas
        DB::table('carreras')->insert(['clave' => 'LQFB','carrera' => 'Licenciatura en Químico Farmacéutico Biólogo','division_id' => 1]);
        DB::table('carreras')->insert(['clave' => 'INAB','carrera' => 'Ingeniería en Alimentos y Biotecnología','division_id' => 1]);
        DB::table('carreras')->insert(['clave' => 'LQUI','carrera' => 'Licenciatura en Química','division_id' => 1]);
        DB::table('carreras')->insert(['clave' => 'LIMA','carrera' => 'Licenciatura en Matemáticas','division_id' => 1]);
        DB::table('carreras')->insert(['clave' => 'LIFI','carrera' => 'Licenciatura en Física','division_id' => 1]);

        //División de Ingenierías
        DB::table('carreras')->insert(['clave' => 'INDU','carrera' => 'Ingeniería Industrial','division_id' => 2]);
        DB::table('carreras')->insert(['clave' => 'ITOG','carrera' => 'Ingeniería en Topografía Geomática','division_id' => 2]);        
        DB::table('carreras')->insert(['clave' => 'ILOT','carrera' => 'Ingeniería en Logística y Transporte','division_id' => 2]);               
        DB::table('carreras')->insert(['clave' => 'ICIV','carrera' => 'Ingeniería Civil']);
        DB::table('carreras')->insert(['clave' => 'INQU','carrera' => 'Ingeniería Química','division_id' => 2]);
        
        // División de Tecnologías para la Integración Ciber-Humana        
        DB::table('carreras')->insert(['clave' => 'IGFO','carrera' => 'Ingeniería Fotónica','division_id' => 3]);  
        DB::table('carreras')->insert(['clave' => 'INME','carrera' => 'Ingeniería Mecánica Eléctrica','division_id' => 3]);  
        DB::table('carreras')->insert(['clave' => 'INBI','carrera' => 'Ingeniería Biomédica','division_id' => 3]);
        DB::table('carreras')->insert(['clave' => 'INRO','carrera' => 'Ingeniería Robótica','division_id' => 3]);
        DB::table('carreras')->insert(['clave' => 'INCE','carrera' => 'Ingeniería en Comunicaciones y Electrónica','division_id' => 3]);        
        DB::table('carreras')->insert(['clave' => 'INNI','carrera' => 'Ingeniería Informática','division_id' => 3]);
        DB::table('carreras')->insert(['clave' => 'INFO','carrera' => 'Licenciatura en Informática','division_id' => 3]);
        DB::table('carreras')->insert(['clave' => 'INCO','carrera' => 'Ingeniería en Computación','division_id' => 3]);    
    
        /*DB::table('carreras')->insert(['clave' => 'INBI','carrera' => 'Ingeniería Biomédica', 'nombre_coordinador' => 'Mtro. Victor Ernesto Moreno González']);
        DB::table('carreras')->insert(['clave' => 'INNI','carrera' => 'Ingeniería Informática', 'nombre_coordinador' => 'Mtra. Sara Esquivel Torres']);
        DB::table('carreras')->insert(['clave' => 'INFO','carrera' => 'Licenciatura en Informática', 'nombre_coordinador' => '']);
        DB::table('carreras')->insert(['clave' => 'INCE','carrera' => 'Ingeniería en Comunicaciones y Electrónica', 'nombre_coordinador' => 'Mtro. Moisés Gilberto Pérez Martínez']);
        DB::table('carreras')->insert(['clave' => 'INCO','carrera' => 'Ingeniería en Computación', 'nombre_coordinador' => 'Mtro. José Luis David Bonilla Carranza']);
        DB::table('carreras')->insert(['clave' => 'IGFO','carrera' => 'Ingeniería Fotónica', 'nombre_coordinador' => 'Dr. Azael de Jesús Mora Nuñez']);
        DB::table('carreras')->insert(['clave' => 'INRO','carrera' => 'Ingeniería Robótica', 'nombre_coordinador' => 'Dra. Irene Gómez Jiménez']);        */
    }


}
