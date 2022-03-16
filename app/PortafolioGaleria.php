<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PortafolioGaleria extends Model
{
    protected $table = 'portafolio_galeria';
    protected $primaryKey = 'id';
    protected $fillables = [
        'img',
        'portafolio_id',
        'order'
    ];

    public $timestamps = false;
}
