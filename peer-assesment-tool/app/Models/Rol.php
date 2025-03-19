<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rol';

    protected $fillable = ['naam'];

    protected $primaryKey = 'id';

    protected $casts = [
        'id' => 'integer',
        'naam' => 'string'
    ];

    public $timestamps = false;

    public function gebruiker() {
        return $this->hasMany(Gebruiker::class, 'rol_id');
    }

}
