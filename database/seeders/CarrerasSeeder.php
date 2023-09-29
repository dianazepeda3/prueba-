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
        DB::table('carreras')->insert(['clave' => 'INBI','carrera' => 'Ingeniería Biomédica', 'nombre_coordinador' => 'Mtro. Victor Ernesto Moreno González']);
        DB::table('carreras')->insert(['clave' => 'INNI','carrera' => 'Ingeniería Informática', 'nombre_coordinador' => 'Mtra. Sara Esquivel Torres']);
        DB::table('carreras')->insert(['clave' => 'INFO','carrera' => 'Licenciatura en Informática', 'nombre_coordinador' => '']);
        DB::table('carreras')->insert(['clave' => 'INCE','carrera' => 'Ingeniería en Comunicaciones y Electrónica', 'nombre_coordinador' => 'Mtro. Moisés Gilberto Pérez Martínez']);
        DB::table('carreras')->insert(['clave' => 'INCO','carrera' => 'Ingeniería en Computación', 'nombre_coordinador' => 'Mtro. José Luis David Bonilla Carranza']);
        DB::table('carreras')->insert(['clave' => 'IGFO','carrera' => 'Ingeniería Fotónica', 'nombre_coordinador' => 'Dr. Azael de Jesús Mora Nuñez']);
        DB::table('carreras')->insert(['clave' => 'INRO','carrera' => 'Ingeniería Robótica', 'nombre_coordinador' => 'Dra. Irene Gómez Jiménez']);        
    }


}
