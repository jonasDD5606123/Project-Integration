<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groep extends Model
{
    protected $table = 'groepen';
    protected $primaryKey = 'id';
    protected $fillable = [
        'naam',
        'vak_id',
        'evaluatie_id'
    ];

    public $incrementing = true;
    public $timestamps = false;
    public $casts = [
        'id' => 'int',
        'naam' => 'string',
        'vak_id' => 'int',
        'evaluatie_id' => 'int'
    ];

    public function vak()
    {
        return $this->belongsTo(Vak::class, 'vak_id');
    }

    public function evaluatie()
    {
        return $this->belongsTo(Evaluatie::class, 'evaluatie_id');
    }

    public function studenten()
    {
        return $this->belongsToMany(Gebruiker::class, 'studenten_groepen', 'groep_id', 'student_id');
    }
}