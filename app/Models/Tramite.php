<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    use HasFactory;

    protected $fillable = [
        'estado',
        'alumno_id',
        'error',
    ];

    public function alumno(){
        return $this->belongsTo(Alumno::class);
    }
}
