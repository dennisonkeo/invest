<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    //
    public $timestamps = false;

    public function quizzes()
    {
    	return $this->hasMany(SurveyQuiz::class);
    }
}
