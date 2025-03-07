<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vak extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];
    protected $casts = [
        'id' => 'int',
        'name' => 'string'
    ];

    public $incrementing = true;
    public $timestamps = false;
}
