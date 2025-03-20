<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Criteria extends Model
{
    protected $table = 'criteria';
    protected $primaryKey = 'id';
    protected $fillable = [
        'criterium',
        'max_waarde',
        'min_waarde',
    ];

    public $incrementing = true;
    public $timestamps = false;
    public $casts = [
        'criterium' => 'string',
        'max_waarde' => 'int',
        'min_waarde' => 'int'
    ];
}
