<?php

use LaravelBook\Ardent\Ardent;

class Answer extends Ardent{
    
    protected $table = "answers";
    
    protected $fillable = array('answer','is_right_answer','order_of_answer');
    
    //protected fields : id, question_id
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      
    );
    
    /**
     * each answer belong to one question
     */
    public function question()
    {
        return $this->belongsTo('Question', 'question_id');
    }
    

    
}

