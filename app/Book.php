<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded =[];

    public function genres() {
        return $this->belongsToMany('App\Genre')->withPivot('id');
    }

    public function authors() {
        return $this->belongsToMany('App\Author')->withPivot('id');
    }

    public function users() {
        return $this->belongsToMany('App\User')->withPivot('id');
    }

    public function publisher() {
        return $this->belongsTo('App\Publisher');
    }
}
