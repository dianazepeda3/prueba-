<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpcionTitulacion extends Model
{
    use HasFactory;

    protected $table = "opciones_titulacion";

    public function alumnos(){
        return $this->hasMany(Alumno::class, 'id_opcion_titulacion', 'id');
    }
}
