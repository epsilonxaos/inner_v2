<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'metaAuthor',
        'metaKeywords',
        'metaDescription',
        'metaOgTitle',
        'metaOgUrl',
        'metaOgDescription',
        'archivoFavicon',
        'archivoOgImagen',
        'idAnalitics',
        'sitemap',
        'code',
    ];

    public static function upload($_file, $path){
        $path_file = $_file->store($path);
        $_exploded = explode('/', $path_file);
        $_exploded[0] = 'storage';
        $path_file = implode('/', $_exploded);
        return $path_file;
    }

}
