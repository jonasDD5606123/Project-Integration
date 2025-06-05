<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Klas extends Model
{
    protected $table = 'klassen';
    protected $primaryKey = 'id';
    protected $fillable = [
        'naam',
        'vak_id'
    ];

    public $incrementing = true;
    public $timestamps = false;
    public $casts = [
        'id' => 'int',
        'naam' => 'string',
        'vak_id' => 'int'
    ];

    public function vak()
    {
        return $this->belongsTo(Vak::class, 'vak_id');
    }

    public function studenten()
    {
        return $this->belongsToMany(Gebruiker::class, 'studenten_klassen', 'klas_id', 'student_id');
    }
}
