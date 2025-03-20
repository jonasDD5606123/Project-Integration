<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< Updated upstream

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


=======
class Evaluatie extends Model
{
    protected $table = 'evaluaties';
    protected $primaryKey = 'id';
    protected $fillable = [
        'titel',
        'beschrijving',
        'deadline',
    ];

    public $incrementing = true;
    public $timestamps = false;
    public $casts = [
        'titel' => 'string',
        'beschrijving' => 'string',
        'deadline' => 'datetime'
    ];
>>>>>>> Stashed changes
}
