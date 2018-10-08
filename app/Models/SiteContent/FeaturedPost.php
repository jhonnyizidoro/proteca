<?php

namespace App\Models\SiteContent;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class FeaturedPost extends Model
{
    protected $fillable = [
		'post_id'
	];

	public $timestamps = false;

	public function post()
	{
		return $this->belongsTo(Post::class);
	}
}
