<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
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

    public function getPrologue(int $length = 180){
        $text = strip_tags($this->body);
        if (strlen($text) > $length) {
            return substr($text, 0, $length).'...';
        }
        return $text;
    }
}
