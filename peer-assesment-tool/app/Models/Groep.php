<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groep extends Model
{
    protected $table = 'groepen';
    protected $primaryKey = 'id';
    protected $fillable = [
        'naam',
        'vak_id'
    ];

    public $incrementing = true;
    public $timestamps = false;
    public $casts = [
        'id' => 'int',
        'naam' => 'string',
        'vak_id' => 'int'
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'groep_id');
    }
}