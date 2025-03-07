<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'Student';

    protected $fillable = ['gebruiker_id', 'klas_id', 'groep_id'];

    protected $primaryKey = 'id';

    protected $casts = [
        'id' => 'integer',
        'gebruiker_id' => 'integer',
        'klas_id' => 'integer',        
        'groep_id' => 'integer',
    ];

    public function gebruiker()
    {
        return $this->belongsTo(Gebruiker::class, 'gebruiker_id');
    }
    public function klas()
    {
        return $this->belongsTo(Klas::class, 'klas_id');
    }
    public function groep()
    {
        return $this->belongsTo(Groep::class, 'groep_id');
    }

    public function student_vak() {
        return $this->hasMany(Student_Vak::class, 'student_id');
    }
}
