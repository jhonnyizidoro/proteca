<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    protected $fillable = [
        'name', 'date', 'address', 'details', 'starts_at', 'ends_at'
    ];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
    }

    public function getDateAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
    }

    public function getStartsAtAttribute($time)
    {
        return mb_substr($time, 0, 5);
    }

    public function getEndsAtAttribute($time)
    {
        return mb_substr($time, 0, 5);
	}
	
	public function getShortName($length = 45)
    {
        $name = $this->name;
        if (strlen($name) > $length) {
            return mb_substr($name, 0, $length).'...';
        }
        return $name;
	}
}
