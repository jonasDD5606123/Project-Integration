<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rollen';
    protected $primaryKey = 'id';
    protected $fillable = [
        'naam'
    ];

    public $incrementing = true;
    public $timestamps = false;
    public $casts = [
        'id' => 'int',
        'naam' => 'string'
    ];
}
