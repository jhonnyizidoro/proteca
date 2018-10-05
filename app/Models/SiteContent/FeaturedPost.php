<?php

namespace App\Models\SiteContent;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class FeaturedPost extends Model
{
    protected $fillable = [
		'post_id'
	];

	public function posts()
	{
		return $this->hasMany(Post::class);
	}
}
