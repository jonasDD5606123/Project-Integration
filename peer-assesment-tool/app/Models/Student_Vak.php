<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student_Vak extends Model
{
    protected $table = 'Student_Vak';

    protected $fillable = ['student_id', 'vak_id'];


    protected $casts = [
        'student_id' => 'integer',
        'vak_id' => 'integer'
    ];

    public function student() {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function vak() {
        return $this->belongsTo(Vak::class, 'vak_id');
    }
}
