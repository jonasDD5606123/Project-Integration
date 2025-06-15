<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// 	id	titel	beschrijving	deadline	vak_id
class Evaluatie extends Model
{
    protected $table = 'evaluaties';
    protected $fillable = ['id', 'titel', 'beschrijving', 'deadline', 'vak_id'];
    protected $primaryKey = 'id';

    public $incrementing = true;
    public $timestamps = false;
    public $casts = [
        'id' => 'integer',
        'titel' => 'string',
        'beschrijving' => 'string',
        'deadline' => 'datetime',
        'vak_id' => 'integer'
    ];

    public function vak()
    {
        return $this->belongsTo(Vak::class, 'vak_id');
    }

    public function groepen()
    {
        return $this->hasMany(Groep::class, 'evaluatie_id');
    }

    public function criteria()
    {
        return $this->hasMany(Criterium::class, 'evaluatie_id');
    }

    public function scores()
    {
        return $this->hasManyThrough(
            \App\Models\Score::class,      // The final model
            \App\Models\Criterium::class,  // The intermediate model
            'evaluatie_id',                // Foreign key on criteria table...
            'criterium_id',                // Foreign key on scores table...
            'id',                          // Local key on evaluaties table...
            'id'                           // Local key on criteria table...
        );
    }


    public function studenten()
    {
        return $this->hasManyThrough(
            Gebruiker::class,      // Final model (student)
            Groep::class,          // Intermediate model (groep)
            'evaluatie_id',        // Foreign key on groepen table
            'id',                  // Foreign key on gebruikers table (assuming 'id')
            'id',                  // Local key on evaluaties table
            'id'                   // Local key on groepen table
        );
    }

    public function allStudenten()
    {
        return $this->groepen->flatMap->studenten->unique('id');
    }

}