<?php

namespace App\Models;

/*
1 Student
2 Docent
3 Admin 
*/

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rollen';
    protected $primaryKey = 'id';
    protected $fillable = [
        'naam'
    ];

    public $incrementing = true;
    public $timestamps = false;
    public $casts = [
        'id' => 'int',
        'naam' => 'string'
    ];

    public function gebruikers()
    {
        return $this->hasMany(Gebruiker::class, 'rol_id');
    }
}