<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'director_id',
        'secretario_id',
    ];

    public function maestro(){
        return $this->belongsTo(Maestro::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
