<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'email',
        'nombre',
        'codigo',
        'grado',
        'genero',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function division(){
        return $this->hasOne(Division::class);
    }
    
}
