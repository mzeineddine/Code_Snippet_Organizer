<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    function snippet(){
        return $this->belongsTo(Tag::class);
    }
}
