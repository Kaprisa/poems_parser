<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poem extends Model
{
    public function author() {
        return $this->belongsTo('App\Author');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }

}
