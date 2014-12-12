<?php


class QuestionType extends Eloquent{
    
    PUBLIC STATIC $QUESTION_TYPE_CHOICE_ONE = 1;
    PUBLIC STATIC $QUESTION_TYPE_MULTI_CHOICE = 2;
    
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
