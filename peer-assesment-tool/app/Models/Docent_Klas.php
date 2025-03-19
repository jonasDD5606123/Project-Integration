<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docent_Klas extends Model
{
    protected $table = 'Docent_Klas';

    protected $fillable = ['docent_id', 'klas_id'];


    protected $casts = [
        'docent_id' => 'integer',
        'klas_id' => 'integer'
    ];

    public function docent() {
        return $this->belongsTo(Docent::class, 'docent_id');
    }

    public function klas() {
        return $this->belongsTo(Klas::class, 'klas_id');
    }

}
