<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    protected $fillable = [
        'name', 'date', 'url', 'organizer', 'location', 'details', 'starts_at', 'ends_at'
    ];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
    }

    public function getStartsAtAttribute($time)
    {
        return substr($time, 0, 5);
    }

    public function getEndsAtAttribute($time)
    {
        return substr($time, 0, 5);
    }
}
