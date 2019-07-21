<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = ['title', 'description', 'user_id'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function question() {
        return $this->hasMany('App\Question');
    }
}
