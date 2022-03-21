<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $primaryKey = 'id';
    public $table = 'customer';
    protected $fillable = [
        'user_id',
        'name',
        'lastname',
        'phone',
        'email',
        'birthdate',
        'address',
        'colony',
        'city',
        'state',
        'country',
        'zip',
        'status'
    ];
}
