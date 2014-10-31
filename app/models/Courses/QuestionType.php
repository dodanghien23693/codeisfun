<?php

use LaravelBook\Ardent\Ardent;

class QuestionType extends Ardent{
    
    protected $table = "question_type";
    
    protected $fillable = array('name');
    
    //protected fields : id
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      
    );
    
    /**
     * each questiontype has many  questions
     */
    public function questions()
    {
        return $this->hasMany('Question');
    }
    

    
}
