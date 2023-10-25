<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinador extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'admin_id',
        'carrera_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function carrera(){
        return $this->belongsTo(Carrera::class, 'carrera_id', 'id');
    }
}
