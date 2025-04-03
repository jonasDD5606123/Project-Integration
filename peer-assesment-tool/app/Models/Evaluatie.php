<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// 	id	titel	beschrijving	deadline	vak_id
class Evaluatie extends Model
{
    protected $table = 'evaluaties';
    protected $fillable = ['id', 'titel', 'beschrijving', 'deadline', 'vak_id'];
    protected $primaryKey = 'id';

    public $casts = [
        'id' => 'integer',
        'titel' => 'string',
        'beschrijving' => 'string',
        'deadline' => 'date',
        'vak_id' => 'integer'
    ];
    public $incrementing = true;
    public $timestamps = false;
}
