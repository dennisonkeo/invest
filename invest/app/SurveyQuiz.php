<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyQuiz extends Model
{
    //
    public $timestamps = false;

    public function options()
    {
    	return $this->hasMany(QuizOp::class);
    }

    public function survey()
    {
    	return $this->belongsTo(Survey::class);
    }
}
