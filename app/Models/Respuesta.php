<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_encuestado',
        'id_encuesta',
        'tipo_respuesta',
        'puntuacion',
        'entrada_texto',
        'seleccion',
    ];

    protected $casts = [
        'seleccion' => 'json',
    ];
}
