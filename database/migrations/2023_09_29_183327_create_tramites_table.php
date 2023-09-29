<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTramitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tramites', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->tinyInteger('estado'); 

            /* 
               1: datos no registrados
               2: datos registrados 
               3: documentos entregados 1a etapa
               4: documentos validados (aprobado) 1a etapa
               5: 2da etapa
               6: documentos validados (aprobado) 2da etapa
               7: datos de titulacion
               8: Biblioteca
               9: concluido 
               0: error
            */
            // 1: datos registrados 2: documentos entregados y validados (aprobado) 3: generacion de documentos 4: concluido 5: error
            
            $table->tinyInteger('estado_anterior_error')->nullable();
            $table->unsignedBigInteger('alumno_id');
            $table->string('error')->nullable()->default(null);

            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('cascade')->onUpdate('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tramites');
    }
}
