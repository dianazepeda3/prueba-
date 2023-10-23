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
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
           
            //$table->unsignedBigInteger('user_id')->nullable();   
            $table->unsignedBigInteger('director_id')->nullable();            
            $table->unsignedBigInteger('secretario_id')->nullable();

            $table->string('nombre_division');
            $table->string('clave');

            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('director_id')->references('id')->on('maestros')->onDelete('cascade')->onUpdate('cascade');                       
            $table->foreign('secretario_id')->references('id')->on('maestros')->onDelete('cascade')->onUpdate('cascade');                                   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('divisions');
    }
};
