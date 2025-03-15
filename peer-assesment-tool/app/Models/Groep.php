<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groep extends Model
{
    protected $table = 'Groep';

    protected $fillable = ['naam', 'vak_id'];

    protected $primaryKey = 'id';

    protected $casts = [
        'id' => 'integer',
        'naam' => 'string',
        'vak_id' => 'integer'
    ];

    public function student()
    {
        return $this->hasMany(Student::class, 'groep_id');
    }

    public function vak()
    {
        return $this->belongsTo(Vak::class, 'vak_id');
    }
}
