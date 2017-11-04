<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function authors() {
        return $this->hasMany('App\Author');
    }

    public function poems() {
        return $this->hasMany('App\Poem');
    }
}
