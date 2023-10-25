<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function alumnos(){
        return $this->hasMany(Alumno::class, 'id_carrera', 'id');
    }    

    public function coordinador(){
        return $this->hasOne(Coordinador::class);
    }

    public function division(){
        return $this->hasOne(Division::class);
    }
}
