<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use Carbon\Carbon;

class Work extends Model
{
    protected $fillable = [
        'title', 'category_id', 'file', 'abstract'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
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

    public function getFileName()
    {
        $array = explode('/', $this->file);
        return end($array);
	}
	
	public function getFilePath($prefix = null)
	{
		if ($this->file != null){
			return $prefix . $this->file;
		}
		return null;
	}

    public function getShortTitle($length = 55)
    {
        $title = $this->title;
        if (strlen($title) > $length) {
            return mb_substr($title, 0, $length).'...';
        }
        return $title;
	}
	
	public function getPrologue(int $length = 180){
		$text = strip_tags($this->abstract);
        if (strlen($text) > $length) {
            return mb_substr($text, 0, $length).'...';
		}
        return $text;
    }

}
