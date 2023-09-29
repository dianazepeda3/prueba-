<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OpcionesTitulacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {                
        DB::table('opciones_titulacion')->insert(['nombre' => 'I. Excelencia académica','articulo_id' => '1', 'fraccion' => 'I', 'opcion' => 'Excelencia Académica',]);
        DB::table('opciones_titulacion')->insert(['nombre' => 'II. Titulación por promedio','articulo_id' => '1', 'fraccion' => 'II', 'opcion' => 'Titulación por promedio',]);
        
        DB::table('opciones_titulacion')->insert(['nombre' => 'I. Examen global teórico práctico','articulo_id' => '2', 'fraccion' => 'I', 'opcion' => 'Examen global teórico práctico',]);
        DB::table('opciones_titulacion')->insert(['nombre' => 'II. Examen global teórico','articulo_id' => '2', 'fraccion' => 'II', 'opcion' => 'Examen global teórico',]);
        DB::table('opciones_titulacion')->insert(['nombre' => 'III. Examen general de certificación profesional (CENEVAL)','articulo_id' => '2', 'fraccion' => 'III', 'opcion' => 'Examen general de certificación profesional',]);
        DB::table('opciones_titulacion')->insert(['nombre' => 'IV. Examen de capacitación profesional','articulo_id' => '2', 'fraccion' => 'IV', 'opcion' => 'Examen de capacitación profesional',]);

        DB::table('opciones_titulacion')->insert(['nombre' => 'I. Guías comentadas o ilustradas','articulo_id' => '3', 'fraccion' => 'I', 'opcion' => 'Guías comentadas o ilustradas',]);
        DB::table('opciones_titulacion')->insert(['nombre' => 'II. Paquete Didáctico','articulo_id' => '3', 'fraccion' => 'II', 'opcion' => 'Paquete Didáctico',]);

        DB::table('opciones_titulacion')->insert(['nombre' => 'I. Cursos de maestría o doctorado en IES de reconocido prestigio','articulo_id' => '4', 'fraccion' => 'I', 'opcion' => 'Cursos de maestría o doctorado en IES de reconocido prestigio',]);
        DB::table('opciones_titulacion')->insert(['nombre' => 'II. Trabajo monográfico de actualización','articulo_id' => '4', 'fraccion' => 'II', 'opcion' => 'Trabajo monográfico de actualización',]);
        DB::table('opciones_titulacion')->insert(['nombre' => 'III. Seminario de investigación','articulo_id' => '4', 'fraccion' => 'III', 'opcion' => 'Seminario de investigación',]);
        DB::table('opciones_titulacion')->insert(['nombre' => 'IV. Seminario de titulación','articulo_id' => '4', 'fraccion' => 'IV', 'opcion' => 'Seminario de titulación',]);
        DB::table('opciones_titulacion')->insert(['nombre' => 'V. Diseño o rediseño de equipos, aparatos, maquinaria, proceso o sistema de Computación y/o Informática','articulo_id' => '4', 'fraccion' => 'V', 'opcion' => 'Diseño o rediseño de equipos, aparatos, maquinaria, proceso o sistema de Computación y/o Informática',]);
        
        DB::table('opciones_titulacion')->insert(['nombre' => 'I. Tesis','articulo_id' => '5', 'fraccion' => 'I', 'opcion' => 'Tesis',]);
        DB::table('opciones_titulacion')->insert(['nombre' => 'II. Tesina','articulo_id' => '5', 'fraccion' => 'II', 'opcion' => 'Tesina',]);
        DB::table('opciones_titulacion')->insert(['nombre' => 'III. Informe de prácticas profesionales','articulo_id' => '5', 'fraccion' => 'III', 'opcion' => 'Informe de prácticas profesionales',]);
        
        /*
        DB::table('opciones_titulacion')->insert(['nombre' => 'I. Excelencia académica','articulo_id' => '1', 'fraccion' => 'I', 'opcion' => 'Excelencia Académica',]);
        DB::table('opciones_titulacion')->insert(['nombre' => 'II. Titulación por promedio','articulo_id' => '1', 'fraccion' => 'II', 'opcion' => 'Titulación por promedio',]);
        DB::table('opciones_titulacion')->insert(['nombre' => 'II. Examen global teórico','articulo_id' => '2', 'fraccion' => 'II', 'opcion' => 'Examen global teórico',]);
        DB::table('opciones_titulacion')->insert(['nombre' => 'III. Examen general de certificación profesional (CENEVAL)','articulo_id' => '2', 'fraccion' => 'III', 'opcion' => 'Examen general de certificación profesional',]);
        DB::table('opciones_titulacion')->insert(['nombre' => 'IV. Examen de capacitación profesional o técnico - profesional','articulo_id' => '2', 'fraccion' => 'IV', 'opcion' => 'Examen de capacitación profesional o técnico - profesional',]);
        DB::table('opciones_titulacion')->insert(['nombre' => 'I. Guías comentadas o ilustradas','articulo_id' => '3', 'fraccion' => 'I', 'opcion' => 'Guías comentadas o ilustradas',]);
        DB::table('opciones_titulacion')->insert(['nombre' => 'I. Cursos o créditos de maestría o doctorado en Instituciones de Educación Superior de reconocido prestigio','articulo_id' => '4', 'fraccion' => 'I', 'opcion' => 'Cursos o créditos de maestría o doctorado en Instituciones de Educación Superior de reconocido prestigio',]);
        DB::table('opciones_titulacion')->insert(['nombre' => 'III. Seminario de investigación','articulo_id' => '4', 'fraccion' => 'III', 'opcion' => 'Seminario de investigación',]);
        DB::table('opciones_titulacion')->insert(['nombre' => 'V. Diseño o rediseño de Equipo, Aparato o Maquinaria','articulo_id' => '4', 'fraccion' => 'V', 'opcion' => 'Diseño o rediseño de Equipo, Aparato o Maquinaria',]);
        DB::table('opciones_titulacion')->insert(['nombre' => 'I. Tesis','articulo_id' => '5', 'fraccion' => 'I', 'opcion' => 'Tesis',]);
        DB::table('opciones_titulacion')->insert(['nombre' => 'III. Informe de prácticas profesionales','articulo_id' => '5', 'fraccion' => 'III', 'opcion' => 'Informe de prácticas profesionales',]);
        
        */ 
    }
}
