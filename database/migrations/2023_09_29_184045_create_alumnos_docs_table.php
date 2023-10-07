<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosdocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno_docs', function (Blueprint $table) {
            $table->id();                                                                             
            $table->unsignedBigInteger('alumno_id');
            $table->tinyInteger('validado')->default(0); 
            /* 0 - Sin revisar 
               1 - Completo 1er parte
               2 - Incompleto 
               3 - Completo 2da parte
               4 - Incompleto */ 
                 
            //$table->unsignedBigInteger('id_opcion_titulacion')->nullable(); 
            $table->boolean('formato_a')->default(0);           
            $table->boolean('kardex')->default(0);
            $table->boolean('certificado')->default(0);
            $table->boolean('prorroga')->default(0);  
            $table->boolean('carta')->default(0);    
            $table->boolean('formato_c')->default(0);
            $table->boolean('certificado_constancias')->default(0);     
            $table->boolean('testimonio_desempeno')->default(0);  
            $table->boolean('reporte_individual_resultados')->default(0); 
            $table->boolean('formato_d')->default(0); 
            $table->boolean('protocolo')->default(0); 
            $table->boolean('contenido_asignatura')->default(0); 
            $table->boolean('constancia_ganador_pm')->default(0); 
            $table->boolean('dictamen')->default(0); 
            $table->boolean('comprobante_academica')->default(0); 

            $table->boolean('publicacion')->default(0);
            $table->boolean('declaratoria')->default(0);
            $table->boolean('evidencia')->default(0);
            $table->boolean('resena_trabajo')->default(0);
            $table->boolean('reporte_escrito')->default(0);
            $table->boolean('curriculum_academico')->default(0);
            $table->boolean('constancia_calificaciones')->default(0);
            $table->boolean('folleto')->default(0);
            $table->boolean('certificados_ceneval')->default(0);
            
            $table->boolean('constancia_no_adeudo_universidad')->default(0);
            $table->boolean('constancia_no_adeudo_biblioteca')->default(0);
            $table->boolean('solicitud_constancia_no_adeudo_universidad')->default(0);
            $table->boolean('solicitud_constancia_no_adeudo_biblioteca')->default(0);
            $table->boolean('validacion_constancia_universidad')->default(0);
            $table->boolean('validacion_constancia_biblioteca')->default(0);

            $table->boolean('documento_trabajo')->default(0);
            
            $table->boolean('autorizacion_publicacion')->default(0);
            $table->boolean('autorizacion_impresion')->default(0);

            $table->boolean('pago_arancel')->default(0);
            
            //Datos FK
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('cascade')->onUpdate('cascade');
            //$table->foreign('id_opcion_titulacion')->references('id_opcion_titulacion')->on('alumnos')->onDelete('cascade')->onUpdate('cascade');           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos_docs');
    }
}
