<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = ['choice', 'question_id'];

    public function question() {
        return $this->belongsTo('App\Question');
    }

    public function answers() {
        return $this->hasMany('App\Answer');
    }
}
