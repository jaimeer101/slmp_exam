<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'posts';

    public function user(){
        return $this->belongsTo(User::class, "users_id", "id");

    }

    public function comments(){
        return $this->hasMany(Comment::class, "posts_id", "id");

    }

}
