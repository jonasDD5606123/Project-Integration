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
        'deadline' => 'date',
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
}