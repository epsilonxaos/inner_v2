<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticias extends Model
{
    protected $table = 'noticias';
    protected $primaryKey = 'id';
    protected $fillable = [
        'categorias_id',
        'portada',
        'titulo',
        'descripcion_corta',
        'contenido',
        'status'
    ];
}
