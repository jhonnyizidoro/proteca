<?php

namespace App\Models\SiteContent;

use Illuminate\Database\Eloquent\Model;

class FeaturedVideo extends Model
{
    protected $fillable = [
		'title', 'url', 'main'
	];

	public $timestamps = false;
}
