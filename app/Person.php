<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'name', 'email', 'image', 'facebook', 'linkedin', 'lattes', 'presentation', 'type'
    ];

    public $timestamps = false;

    public function getNameAttribute($name)
    {
		if ($this->type === 'team'){
			$nameArray = explode(' ', $name);
			if (sizeof($nameArray) === 1){
				return $name;
			}
			return "{$nameArray[0]} ".end($nameArray);
		}
        return $name;
    }

}