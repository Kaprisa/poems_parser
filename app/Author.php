<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function poems() {
        return $this->hasMany('App\Poem');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }

}
