<?php

namespace App\Models\SiteContent;

use Illuminate\Database\Eloquent\Model;

class FeaturedVideo extends Model
{
    protected $fillable = [
		'title', 'url', 'main'
	];

	public $timestamps = false;

	public function getVideoEmbedLink()
	{
		$urlParts = parse_url($this->url);
		parse_str($urlParts['query'], $urlParameters);
		return "https://www.youtube.com/embed/{$urlParameters['v']}";
	}
}
