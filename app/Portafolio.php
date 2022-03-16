<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portafolio extends Model
{
    protected $table = 'portafolio';
    protected $primaryKey = 'id';
    protected $fillable = [
        'cover',
        'portada',
        'nombre',
        'categoria_id',
        'descripcion',
        'status',
    ];
}
