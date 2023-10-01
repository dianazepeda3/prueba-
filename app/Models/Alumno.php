<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',       

        // Datos escolares  
        'ciclo_ingreso',
        'ciclo_egreso',
        'id_carrera',
        'id_articulo',
        'id_opcion_titulacion',
        'plan_estudios',
        'situacion',

        // Datos personales
        'fecha_nacimiento',
        'estado_civil',
        'lugar_nac,',
        'domicilio',
        'telefono_celular',
        'telefono_particular',
        'correo_institucional',
        'correo_particular',

        // Datos laborales
        'nombre_empresa',
        'puesto',
        'domicilio_empresa',
        'telefono_empresa',
        'sueldo',        
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function carrera(){
        return $this->belongsTo(Carrera::class, 'id_carrera', 'id');
    }

    public function tramite(){
        return $this->hasOne(Tramite::class);
    }

    public function alumno_docs(){
        return $this->hasOne(AlumnoDocs::class);
    }

    public function articulo(){
        return $this->belongsTo(Articulo::class, 'id_articulo', 'id');
    }

    public function opcion_titulacion(){
        return $this->belongsTo(OpcionTitulacion::class, 'id_opcion_titulacion', 'id');
    }

    public function plan_estudios(){
        return $this->belongsTo(PlanEstudios::class, 'id_plan_estudios', 'id');
    }
}
