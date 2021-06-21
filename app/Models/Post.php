<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	 protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

     //many to many relation with the user
    public function likes()
    {
        return $this->belongsToMany(User::class);
    }

    //relation with the poat and comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
