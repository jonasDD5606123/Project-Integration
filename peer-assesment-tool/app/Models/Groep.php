<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groep extends Model
{
    protected $table = 'Groep';

    protected $fillable = ['naam', 'vak_id'];

    protected $primaryKey = 'id';

    protected $casts = [
        'id' => 'integer',
        'naam' => 'string',
        'vak_id' => 'integer'
    ];
}
