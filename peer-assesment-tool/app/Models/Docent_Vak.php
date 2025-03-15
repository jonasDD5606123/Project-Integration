<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docent_Vak extends Model
{
    protected $table = 'Docent_Vak';

    protected $fillable = ['docent_id', 'vak_id'];


    protected $casts = [
        'docent_id' => 'integer',
        'vak_id' => 'integer'
    ];

    public function docent() {
        return $this->belongsTo(Docent::class, 'docent_id');
    }

    public function vak() {
        return $this->belongsTo(Vak::class, 'vak_id');
    }
}
