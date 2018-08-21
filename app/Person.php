<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'name', 'email', 'image', 'facebook', 'linkedin', 'lattes', 'presentation', 'type'
    ];

    public $timestamps = false;

}