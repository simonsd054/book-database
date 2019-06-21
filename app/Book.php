<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    public function genres() {
        return $this->belongsToMany('App\Genre');
    }

    public function authors() {
        return $this->belongsToMany('App\Author');
    }

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function publisher() {
        return $this->belongsTo('App\Publisher');
    }
}
