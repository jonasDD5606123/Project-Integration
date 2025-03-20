<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluatie extends Model
{
    protected $table = 'Evaluatie';
    protected $fillable = ['name', 'description', 'evaluater_id', 'evaluated_id', 'date'];
    protected $primaryKey = 'id';

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'date' => 'date',
        'evaluater_id' => 'integer',
        'evaluated_id' => 'integer'
    ];


}
