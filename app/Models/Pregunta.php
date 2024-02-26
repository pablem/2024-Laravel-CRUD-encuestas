<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'id_encuesta',
        'titulo_pregunta',
        'tipo_pregunta',
        'rango_puntuacion',
        'opciones'
    ];
    protected $casts = [
        'rango_puntuacion' => 'json', //por qué no un max y min (smallint)????
        'opciones' => 'json',
    ];
    // es seleccion multiple
}
