<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;


class Gebruiker extends User
{
        use Notifiable;
    protected $table = 'gebruikers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'r_nummer',
        'voornaam',
        'achternaam',
        'email',
        'password',
        'rol_id'
    ];

    public $incrementing = true;
    public $timestamps = false;
    public $casts = [
        'id' => 'int',
        'r_nummer' => 'string',
        'voornaam' => 'string',
        'achternaam' => 'string',
        'email' => 'string',
        'password' => 'string',
        'rol_id' => 'int'
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function klassen()
    {
        return $this->belongsToMany(Klas::class, 'studenten_klassen', 'student_id', 'klas_id');
    }

    public function groepen()
    {
        return $this->belongsToMany(Groep::class, 'studenten_groepen', 'student_id', 'groep_id');
    }

    public function vakken()
    {
        return $this->belongsToMany(Vak::class, 'docenten_vakken', 'docent_id', 'vak_id');
    }
}