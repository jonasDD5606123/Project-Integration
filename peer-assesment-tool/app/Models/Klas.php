<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Klas extends Model
{
    protected $table = 'klassen';
    protected $primaryKey = 'id';
    protected $fillable = [
        'naam',
        'vak_id'
    ];

    public $incrementing = true;
    public $timestamps = false;
    public $casts = [
        'id' => 'int',
        'naam' => 'string',
        'vak_id' => 'int'
    ];
}
