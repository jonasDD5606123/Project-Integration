<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vak extends Model
{

    protected $table = 'Vak';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];
    protected $casts = [
        'id' => 'int',
        'naam' => 'string'
    ];

    public $incrementing = true;
    public $timestamps = false;
}
