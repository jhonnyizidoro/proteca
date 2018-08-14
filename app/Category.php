<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Work;

class Category extends Model
{
    protected $fillable = [
        'category'
    ];

    public $timestamps = false;

    public function works()
    {
        return $this->hasMany(Work::class);
    }
}
