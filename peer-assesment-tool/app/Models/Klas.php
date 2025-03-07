<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Klas extends Model
{
    protected $table = 'Klas';

    protected $fillable = ['naam'];

    protected $primaryKey = 'id';

    protected $casts = [
        'id' => 'integer',
        'naam' => 'string'
    ];
}
