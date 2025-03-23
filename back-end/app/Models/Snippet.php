<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Snippet extends Model
{
    //
    function tags(){
        return $this->hasMany(Tag::class);
    }
}
