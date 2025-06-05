<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// 	id	titel	beschrijving	deadline	vak_id
class StudentGroepen extends Model
{
    protected $table = 'studenten_groepen';
    protected $fillable = ['student_id', 'groep_id'];

    public $casts = [
        'student_id' => 'int',
        'groep_id' => 'int'
    ];
    public $incrementing = false;
    public $timestamps = false;
}
