<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    // Tell Laravel your table doesn't have an auto-incrementing ID
    public $incrementing = false;

    // Tell Laravel your model does NOT have a single-column primary key
    protected $primaryKey = null;

    // If your table name is not 'scores', specify it:
    // protected $table = 'scores';

    // Set the fields you want mass assignable
    protected $fillable = [
        'criterium_id',
        'student_id_geevalueerd',
        'student_id_evalueert',
        'score',
        'feedback',
        'gescoord_op',
    ];

    // Disable timestamps if you don't have created_at and updated_at columns
    public $timestamps = false;
}
