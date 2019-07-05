<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $guarded = [];

    public function books() {
        return $this->belongsToMany('App\Book')->withPivot('id');
    }
}
