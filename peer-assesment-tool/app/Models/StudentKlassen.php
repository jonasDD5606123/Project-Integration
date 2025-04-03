<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// 	id	titel	beschrijving	deadline	vak_id
class StudentKlassen extends Model
{
    protected $table = 'studenten_klassen';
    protected $fillable = ['student_id', 'klas_id'];

    public $casts = [
        'student_id' => 'int',
        'klas_id' => 'int'
    ];
    public $incrementing = false;
    public $timestamps = false;
}
