<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizOp extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'survey_quizzes_id',
        'opt',
    ];

    public function quiz()
    {
    	return $this->belongsTo(SurveyQuiz::class);
    }
}
