<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticulosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('articulos')->insert(['modalidad' => 'I. Desempeño Académico Sobresaliente',
                                        'numero_articulo' => '9',]);
        DB::table('articulos')->insert(['modalidad' => 'II. Exámenes',
                                        'numero_articulo' => '10',]);
        DB::table('articulos')->insert(['modalidad' => 'III. Producción de Materiales Educativos',
                                        'numero_articulo' => '11',]);
        DB::table('articulos')->insert(['modalidad' => 'IV. Investigación y Estudios de Posgrado',
                                        'numero_articulo' => '12',]);
        DB::table('articulos')->insert(['modalidad' => 'V. Tesis, Tesina e Informes',
                                        'numero_articulo' => '14',]);*/
        DB::table('articulos')->insert(['nombre' => 'Artículo 9. Modalidad de Desempeño Académico Sobresaliente.',
                                        'numero_articulo' => '9',
                                        'modalidad' => 'Desempeño Académico Sobresaliente',]);
        DB::table('articulos')->insert(['nombre' => 'Artículo 10. Modalidad de Exámenes.',
                                        'numero_articulo' => '10',
                                        'modalidad' => 'Exámenes',]);
        DB::table('articulos')->insert(['nombre' => 'Artículo 11. Modalidad de Producción de Materiales Educativos.',
                                        'numero_articulo' => '11',
                                        'modalidad' => 'Producción de Materiales Educativos',]);
        DB::table('articulos')->insert(['nombre' => 'Artículo 12. Modalidad de Investigación y Estudios de Posgrado.',
                                        'numero_articulo' => '12',
                                        'modalidad' => 'Investigación y Estudios de Posgrado',]);
        DB::table('articulos')->insert(['nombre' => 'Artículo 14. Modalidad de Tesis, Tesina e Informes.',
                                        'numero_articulo' => '14',
                                        'modalidad' => 'Tesis, Tesina e Informes',]);

    }
}
