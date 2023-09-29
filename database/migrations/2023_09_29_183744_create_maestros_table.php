<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaestrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maestros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('email');
            $table->string('nombre');
            $table->string('codigo',10);
            $table->string('grado');
            $table->string('genero',10);

            $table->boolean('is_secretario_division')->default(0); //secretario de division = 1, maestro = 0
            $table->boolean('is_director_division')->default(0); //director de division = 1, maestro = 0

            $table->boolean('is_presidente_comite')->default(0); //presidente_comite = id_carrera de la que es presidente
            $table->boolean('is_secretario_comite')->default(0); //secretario_comite = id_carrera de la que es secretario
            $table->boolean('is_vocal_comite')->default(0); //vocal_comite = id_carrera de la que es vocal

            //Datos FK
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maestros');
    }
}
