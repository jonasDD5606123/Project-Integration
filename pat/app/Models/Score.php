<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'scores';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'criterium_id',
        'student_id_geevalueerd',
        'student_id_evalueert',
        'score',
        'feedback',
        'gescoord_op'
    ];

    protected $casts = [
        'criterium_id' => 'int',
        'student_id_geevalueerd' => 'int',
        'student_id_evalueert' => 'int',
        'score' => 'float',
        'feedback' => 'string',
        'gescoord_op' => 'datetime'
    ];

    public function criterium()
    {
        return $this->belongsTo(Criterium::class, 'criterium_id');
    }

    public function geevalueerdeStudent()
    {
        return $this->belongsTo(Gebruiker::class, 'student_id_geevalueerd');
    }

    public function evaluator()
    {
        return $this->belongsTo(Gebruiker::class, 'student_id_evalueert');
    }
}
