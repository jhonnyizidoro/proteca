<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SiteContent\FeaturedPost;
use App\Models\User;
use Carbon\Carbon;

class Post extends Model
{
    protected $fillable = [
        'title', 'body', 'thumbnail', 'url', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y - H:i');
    }

    public function getDate()
    {
        return Carbon::createFromFormat('d/m/Y - H:i', $this->created_at)->format('d/m/Y');
    }

    public function getTime()
    {
        return Carbon::createFromFormat('d/m/Y - H:i', $this->created_at)->format('H\hm');
	}
	
	public function featuredPost()
	{
		return $this->hasOne(FeaturedPost::class);
	}

    public function getPrologue(int $length = 180){
		$text = strip_tags($this->body);
        if (strlen($text) > $length) {
            return mb_substr($text, 0, $length).'...';
		}
        return $text;
    }
}
