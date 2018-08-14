<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ocupation;

class Person extends Model
{
    protected $fillable = [
        'name', 'email', 'image', 'facebook', 'linkedin', 'lattes', 'presentation', 'type'
    ];

    public $timestamps = false;

    public function ocupation()
    {
        return $this->hasMany(Ocupation::class);
    }

}
