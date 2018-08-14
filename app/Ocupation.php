<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Person;

class Ocupation extends Model
{
    protected $fillable = [
        'ocupation', 'person_id'
    ];

    public $timestamps = false;

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
