<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['name', 'email', 'password', 'role'];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function favorite()
    {
        return $this->hasMany(Favorite::class);
    }

    public function rating()
    {
        return $this->hasMany(rating::class);
    }
}
