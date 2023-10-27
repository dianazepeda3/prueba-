<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');            
        
            //Datos escolares
            //$table->string('codigo',9);                       
            $table->string('num_expediente')->nullable();
           // $table->string('carrera')->nullable();
            $table->string('situacion')->nullable();
            $table->float('promedio')->nullable();
            $table->string('ciclo_ingreso')->nullable();
            $table->string('ciclo_egreso')->nullable();
            $table->unsignedBigInteger('id_carrera')->nullable();        
            $table->unsignedBigInteger('id_articulo')->nullable();
            $table->unsignedBigInteger('id_opcion_titulacion')->nullable();
            $table->unsignedBigInteger('id_plan_estudios')->nullable();

                //Modalidades que exponen
                $table->string('titulo_del_trabajo')->nullable()->default(null);
                $table->boolean('ganador_proyecto_modular')->default(0);
                $table->float('calificacion_trabajo')->nullable()->default(null);
                $table->string('autores')->nullable()->default(null);

            //Datos personales
            //$table->string('nombre'); 
            $table->char('genero')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('estado_civil')->nullable();

                //Lugar de nacimiento
                $table->string('estado_nacimiento')->nullable();
                $table->string('municipio_nacimiento')->nullable();

                //Domicilio
                $table->string('dom_calle')->nullable();
                $table->string('dom_numero')->nullable();
                $table->string('dom_colonia')->nullable();
                $table->string('dom_CP',5)->nullable();
                $table->string('dom_municipio')->nullable();
                $table->string('dom_estado')->nullable();
                                
            $table->string('telefono_celular')->nullable();
            $table->string('telefono_particular')->nullable();
            $table->string('correo_institucional')->nullable();
            $table->string('correo_part')->nullable();

            //Datos laborales
            $table->boolean('trabaja')->default(false);
            $table->boolean('afin')->default(false);
                //NO AFIN            
                $table->string('descripcion')->nullable();
                //AFIN
                $table->string('nombre_empresa')->nullable();
                $table->string('puesto')->nullable();
                    //Domicilio empresa
                    $table->string('empresa_calle')->nullable();
                    $table->string('empresa_numero')->nullable();
                    $table->string('empresa_colonia')->nullable();
                    $table->string('empresa_CP',5)->nullable();
                    $table->string('empresa_municipio')->nullable();
                    $table->string('empresa_estado')->nullable();
                $table->string('tel_empresa')->nullable();
                $table->string('sueldo_mensual')->nullable();

            //Consecutivo y finalizacion del tramite
            $table->unsignedBigInteger('numero_de_consecutivo')->nullable()->default(null);
            $table->unsignedBigInteger('anio_graduacion')->nullable()->default(null);
            $table->string('consecutivo',10)->nullable()->default(null);

            $table->date('fecha_egreso')->nullable()->default(null);
            $table->date('fecha_titulacion')->nullable()->default(null);
            $table->string('fecha_limite')->nullable()->default(null);

            $table->time('hora_inicio_citatorio')->nullable()->default(null);
            $table->time('hora_fin_citatorio')->nullable()->default(null);

            $table->date('fecha_citatorio')->nullable()->default(null);

            //Ceremonia de graduacion masiva ,individual o toma de protesta en acto academico
            $table->string('tipo_de_ceremonia')->nullable()->default(null);
            //Ceremonia presencial o virtual
            $table->string('tipo_de_ceremonia_presencial_virtual')->nullable()->default(null);
            //Si es virtual seleccionar la liga. Si es presencial seleccionar el lugar
            $table->string('lugar_de_ceremonia')->nullable()->default(null);
           
            //Sinodales
            $table->string('nombre_presidente')->nullable()->default(null);
            $table->unsignedBigInteger('id_maestro_presidente')->nullable()->default(null);

            $table->string('nombre_secretario')->nullable()->default(null);
            $table->unsignedBigInteger('id_maestro_secretario')->nullable()->default(null);

            $table->string('nombre_vocal')->nullable()->default(null);
            $table->unsignedBigInteger('id_maestro_vocal')->nullable()->default(null);

            //$table->string('nombre_director_division')->nullable()->default(null);
            //$table->unsignedBigInteger('id_director_division')->nullable()->default(null);

            //$table->string('nombre_secretario_division')->nullable()->default(null);
            //$table->unsignedBigInteger('id_secretario_division')->nullable()->default(null);


            //Datos FK
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_carrera')->references('id')->on('carreras')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_plan_estudios')->references('id')->on('plan_estudios')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_articulo')->references('id')->on('articulos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_opcion_titulacion')->references('id')->on('opciones_titulacion')->onDelete('cascade')->onUpdate('cascade');

        });
        /*
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('email');
            $table->string('nombre');
            $table->date('fecha_nacimiento') ;
            $table->string('genero',10);
            $table->string('telefono',10);
            $table->string('telefono_fijo',10)->nullable();
            $table->string('codigo',10);
            $table->string('preparatoria');
            $table->unsignedBigInteger('id_carrera');
            $table->unsignedBigInteger('id_plan_estudios');
            $table->unsignedBigInteger('id_articulo');
            $table->unsignedBigInteger('id_opcion_titulacion');
            //Promedio
            $table->float('promedio')->nullable()->default(null);
            //Examenes Ceneval
            $table->float('examen_ceneval_1')->nullable()->default(null);
            $table->float('examen_ceneval_2')->nullable()->default(null);
            $table->float('examen_ceneval_3')->nullable()->default(null);
            $table->float('examen_ceneval_4')->nullable()->default(null);
            $table->float('examen_ceneval_5')->nullable()->default(null);
            $table->float('examen_ceneval_6')->nullable()->default(null);
            $table->float('examen_ceneval_7')->nullable()->default(null);
            $table->float('promedio_examenes_ceneval')->nullable()->default(null);
            $table->float('puntos_globales_ceneval')->nullable()->default(null);

            //Examen Global Teórico
            $table->string('materia_1_global_teorico')->nullable()->default(null);
            $table->string('materia_2_global_teorico')->nullable()->default(null);
            $table->string('materia_3_global_teorico')->nullable()->default(null);
            $table->string('materia_4_global_teorico')->nullable()->default(null);

            $table->float('promedio_global_teorico')->nullable()->default(null);

            //Ganador de proyecto modular si o no
            $table->string('ganador_proyecto_modular' , 2)->nullable()->default(null);

            //Examenes Capacitacion
            $table->string('nombre_certificacion')->nullable()->default(null);
            $table->float('calificacion_examen_capacitacion')->nullable()->default(null);

            //Modalidades que exponen
            $table->string('titulo_del_trabajo')->nullable()->default(null);
            $table->float('calificacion_trabajo')->nullable()->default(null);

            //Cursos o Creditos
            $table->string('nombre_del_curso')->nullable()->default(null);
            $table->float('calificacion_curso')->nullable()->default(null);
            $table->unsignedInteger('cant_materias')->nullable()->default(null);

            //Consecutivo y finalizacion del tramite
            $table->unsignedBigInteger('numero_de_consecutivo')->nullable()->default(null);
            $table->unsignedBigInteger('anio_graduacion')->nullable()->default(null);
            $table->string('consecutivo',10)->nullable()->default(null);

            $table->date('fecha_egreso')->nullable()->default(null);
            $table->date('fecha_titulacion')->nullable()->default(null);

            $table->time('hora_inicio_citatorio')->nullable()->default(null);
            $table->time('hora_fin_citatorio')->nullable()->default(null);

            $table->date('fecha_citatorio')->nullable()->default(null);

            //Ceremonia de graduacion masiva ,individual o toma de protesta en acto academico
            $table->string('tipo_de_ceremonia')->nullable()->default(null);
            //Ceremonia presencial o virtual
            $table->string('tipo_de_ceremonia_presencial_virtual',12)->nullable()->default(null);
            //Si es virtual seleccionar la liga. Si es presencial seleccionar el lugar
            $table->string('lugar_de_ceremonia',100)->nullable()->default(null);

            //Protesta
            $table->boolean('acta_firmada')->default(0); //No firmada= 0, firmada = 1 Esto hace falta para vincular el alumno con los maestros

            //Sinodales
            $table->string('nombre_presidente')->nullable()->default(null);
            $table->unsignedBigInteger('id_maestro_presidente')->nullable()->default(null);

            $table->string('nombre_secretario')->nullable()->default(null);
            $table->unsignedBigInteger('id_maestro_secretario')->nullable()->default(null);

            $table->string('nombre_vocal')->nullable()->default(null);
            $table->unsignedBigInteger('id_maestro_vocal')->nullable()->default(null);

            $table->string('nombre_director_division')->nullable()->default(null);
            $table->unsignedBigInteger('id_director_division')->nullable()->default(null);

            $table->string('nombre_secretario_division')->nullable()->default(null);
            $table->unsignedBigInteger('id_secretario_division')->nullable()->default(null);

            //Datos FK
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_carrera')->references('id')->on('carreras')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_plan_estudios')->references('id')->on('plan_estudios')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_articulo')->references('id')->on('articulos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_opcion_titulacion')->references('id')->on('opciones_titulacion')->onDelete('cascade')->onUpdate('cascade');
            
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos');
    }
}
