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

    public function student()
    {
        return $this->hasMany(Student::class, 'klas_id');
    }

    public function docent_klas() {
        return $this->hasMany(Docent_Klas::class, 'klas_id');
    }
}
