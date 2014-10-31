<?php

use LaravelBook\Ardent\Ardent;

class QuizSubmit extends Ardent{
    
    protected $table = "quiz_submit";
    
    protected $fillable = array('date_submit','score','max_score');
    
    //protected fields : id, quiz_id, user_id
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      
    );
    
    /**
     * each quiz_submit belong to one user
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }
    
    /**
     * each quiz_submit belong to one quiz
     */
    public function quiz()
    {
        return $this->belongsTo('Quiz');
    }

}


