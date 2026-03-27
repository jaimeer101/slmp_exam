<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    //
    protected $table = 'albums';

    public function user(){
        return $this->belongsTo(User::class, "users_id", "id");

    }

    public function photos(){
        return $this->hasMany(Photo::class, "albums_id", "id");

    }
}
