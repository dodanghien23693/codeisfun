<?php

use LaravelBook\Ardent\Ardent;

class QuestionAnswered extends Ardent{
    
    protected $table = "question_answered";
    
    protected $fillable = array('answer');
    
    //protected fields : id, question_id, user_id
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      
    );
    
    /**
     * each question_answered belong to one question
     */
    public function question()
    {
        return $this->belongsTo('Question', 'question_id');
    }
    
    /**
     * each question_answered belong to one user
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    
}


