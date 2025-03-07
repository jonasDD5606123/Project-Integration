<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docent extends Model
{
    protected $table = 'Docent';

    protected $fillable = ['gebruiker_id'];

    protected $primaryKey = 'id';

    protected $casts = [
        'id' => 'integer',
        'gebruiker_id' => 'integer'
    ];
    public function gebruiker() {
        return $this->belongsTo(Gebruiker::class, 'gebruiker_id');
    }

}
