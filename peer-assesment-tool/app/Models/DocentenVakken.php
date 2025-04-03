<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// 	id	titel	beschrijving	deadline	vak_id
class DocentenVakken extends Model
{
    protected $table = 'docenten_vakken';
    protected $fillable = ['docent_id', 'vak_id'];
    protected $primaryKey = ['docent_id', 'vak_id'];

    public $casts = [
        'id' => 'integer',
        'vak_id' => 'integer'
    ];
    public $incrementing = true;
    public $timestamps = false;
}
