<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gebruiker extends Model
{
        protected $table = 'Gebruiker';
        protected $fillable = ['username', 'voornaam', 'familienaam', 'email', 'paswoord', 'rol_id'];
        protected $primaryKey = 'id';

        protected $casts = [
            'id' => 'integer',
            'username' => 'string',
            'voornaam' => 'string',
            'familienaam' => 'string',
            'email' => 'string',
            'paswoord' => 'string',
            'rol_id' => 'integer'
        ];
        public $timestamps = false;

        public function rol() {
            return $this->belongsTo(Rol::class, 'rol_id');
        }

        public function docent() {
            return $this->hasMany(Docent::class, 'gebruiker_id');
        }

        public function student()
        {
            return $this->hasMany(Student::class, 'gebruiker_id');
        }

}
