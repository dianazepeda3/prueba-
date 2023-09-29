<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsAdminToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(0); //admin = 1, user = 0            
            $table->boolean('is_teacher')->default(0); //alumno = 0, profesor = 1
            $table->tinyInteger('admin_type')->default(0);                 
            /* 
               1 - ADMIN 
               2 - Coordinador
               3 - Biblioteca
               4 - Control Escolar 
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
