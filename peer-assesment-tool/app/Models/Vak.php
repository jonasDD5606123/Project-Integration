<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vak extends Model
{
    protected $table = 'Vak';

    protected $fillable = ['naam'];

    protected $primaryKey = 'id';

    protected $casts = [
        'id' => 'integer',
        'naam' => 'string'
    ];

    public function groep()
    {
        return $this->hasMany(Groep::class, 'vak_id');
    }

    public function docent_vak() {
        return $this->hasMany(Docent_Vak::class, 'vak_id');
    }

    public function student_vak() {
        return $this->hasMany(Student_Vak::class, 'vak_id');
    }
}
