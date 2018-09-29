<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use Carbon\Carbon;

class Work extends Model
{
    protected $fillable = [
        'title', 'category_id', 'file', 'abstract', 'url'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y - H:i');
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

}
