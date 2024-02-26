<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Encuesta extends Model
{
    use HasFactory;
    // use Sluggable;

    protected $fillable = [
        // 'user_id', 
        'titulo_encuesta',
        'descripcion',
        'url',
        'estado',
        // 'fecha_creacion',
        // 'fecha_modificacion',
        'fecha_publicacion',
        'fecha_finalizacion',
        'privada',
        'anonima',
        'version'
    ];

    // es publicada
    // dias de publicacion
    // dias restantes 
    // es privada
    // es anonima
    // piloto?? ultima version? 

     /**
     * Al momento de crear una encuesta: se gusrda la fk user 
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($encuesta) {
            $encuesta->user_id = auth()->id();
            $encuesta->titulo_encuesta = 'Encuesta - ' . now()->format('Y-m-d H:i:s');
        });
    }

    /**
     * Get the user record associated with the post.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the comments for the blog post.
     */
    public function numero_preguntas()
    {
        // return $this->hasMany(Pregunta::class);
    }

    // /**
    //  * Return the sluggable configuration array for this model.
    //  *
    //  * @return array
    //  */
    // public function sluggable()
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'titulo_encuesta',
    //             'onUpdate' => true
    //         ]
    //     ];
    // }
}
