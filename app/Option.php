<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = ['option'];

    public function question() {
        return $this->belongsTo('App\Question');
    }

    public function answer() {
        return $this->hasMany('App\Answer');
    }
}
