<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use App\Post;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y - H:i');
    }

    public function assignRole(String $role)
    {
        if (!$this->hasTheRole($role)){
            $role = Role::where('role', $role)->first();
            $this->roles()->attach($role);
            return true;
        }
        return false;
    }

    public function hasTheRole(String $role)
    {
        if ($this->roles()->where('role', $role)->first()){
            return true;
        }
        return false;
    }
    

    public function isAuthorOrAdmin(Post $post)
    {
        if ($this->hasTheRole('admin') || $this == $post->user()->first()) {
            return true;
        }
        return false;
    }

}
