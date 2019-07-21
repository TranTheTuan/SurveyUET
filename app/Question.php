<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['label', 'type', 'survey_id'];

    public function option() {
        return $this->hasMany('App\Option');
    }

    public function answer() {
        return $this->hasMany('App\Answer');
    }

    public function survey() {
        return $this->belongsTo('App\Survey');
    }
}
