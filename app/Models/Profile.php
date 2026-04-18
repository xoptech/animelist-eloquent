<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Database\Factories\ProfileFactory;

#[UseFactory(ProfileFactory::class)]
class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'username', 'avatar', 'bio'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
