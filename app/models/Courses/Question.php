<?php

use LaravelBook\Ardent\Ardent;

class Question extends Ardent{
    
    protected $table = "questions";
    
    protected $fillable = array('question','order_of_question','quiz_id','question_type_id');
    
    //protected fields : id, quiz_id, question_type_id
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      
    );
    
    /**
     * each question belong to one question_type
     */
    public function type()
    {
        return $this->belongsTo('QuestionType', 'question_type_id');
    }
    
    /**
     * each has many answers via answers table
     */
    public function user()
    {
        return $this->hasMany('Answer');
    }
    
    public function answers()
    {
        return $this->hasMany('Answer', 'question_id');
    }

    public function delete()
    {
        $this->answers()->delete();
        return parent::delete();
    }
    
}
