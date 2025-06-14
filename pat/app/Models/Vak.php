<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vak extends Model
{
    protected $table = 'vakken';
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

    public function evaluaties()
    {
        return $this->hasMany(Evaluatie::class, 'vak_id');
    }

    public function groepen()
    {
        return $this->hasMany(Groep::class, 'vak_id');
    }

    public function klassen()
    {
        return $this->hasMany(Klas::class, 'vak_id');
    }

    public function docenten()
    {
        return $this->belongsToMany(Gebruiker::class, 'docenten_vakken', 'vak_id', 'docent_id');
    }
}