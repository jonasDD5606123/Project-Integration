<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Gebruiker extends User
{
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
}
