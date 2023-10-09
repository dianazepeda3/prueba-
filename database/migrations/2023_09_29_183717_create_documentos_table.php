<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_original');
            $table->string('nombre_documento');
            $table->string('ruta');
            $table->string('mime');
            $table->string('comentario')->nullable();
            $table->tinyInteger('aprobado')->nullable()->default(0);
            /* 0 - Entregado             
               1 - Aprobado
               2 - No aprobado
               3 - En revision 
               4 - Doc generado 
               2da etapa
               5 - Aprobado
               6 - No aprobado
               7 - En revision 
               3ra etapa
               8 - Aprobado
               9 - No aprobado
               10 - En revision 
               */
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('id_alumno');
            $table->unsignedBigInteger('tramite_id')->nullable();
            $table->timestamps();
            //$table->unsignedBigInteger('maestro_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');;
            $table->foreign('id_alumno')->references('id')->on('alumnos')->onDelete('cascade')->onUpdate('cascade');;
            $table->foreign('tramite_id')->references('id')->on('tramites')->onDelete('cascade')->onUpdate('cascade');;

            //$table->foreign('maestro_id')->references('id')->on('maestros');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentos');
    }
}
