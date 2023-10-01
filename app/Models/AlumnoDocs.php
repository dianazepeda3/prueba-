<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumnoDocs extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    public function alumno(){
        return $this->belongsTo(Alumno::class);
    }
}
