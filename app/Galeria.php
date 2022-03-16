<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    protected $table = 'galerias';
    protected $primaryKey = 'id';
    protected $fillable = [
        'cover',
        'titulo',
        'seccion',
        'status'
    ];
}
