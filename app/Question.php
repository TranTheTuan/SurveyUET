<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['label', 'type', 'survey_id'];

    public function options() {
        return $this->hasMany('App\Option');
    }

    public function answers() {
        return $this->hasMany('App\Answer');
    }

    public function survey() {
        return $this->belongsTo('App\Survey');
    }

    public function insertQuestionToDB(array $data) {
        return Question::create($data);
    }
}
