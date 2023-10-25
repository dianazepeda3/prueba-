<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordinadors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');   
            $table->unsignedBigInteger('id_maestro')->nullable();
            $table->unsignedBigInteger('carrera_id')->nullable();   
            
            //$table->string('nombre');
            //$table->string('clave');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_maestro')->references('id')->on('maestros')->onDelete('cascade')->onUpdate('cascade');                                   
            $table->foreign('carrera_id')->references('id')->on('carreras')->onDelete('cascade')->onUpdate('cascade');                                   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coordinadors');
    }
};
