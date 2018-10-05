<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Work;

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
