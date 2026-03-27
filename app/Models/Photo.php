<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';

    public function album(){
        return $this->belongsTo(Album::class, "albums_id", "id");

    }
}
