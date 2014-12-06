<?php


class Answer extends Eloquent{
    
    protected $table = "answers";
    
    protected $fillable = array('answer','is_right_answer','order_of_answer','question_id');
    
    //protected fields : id, question_id
    
    /**
    * Ardent validation rules
    */

    
    /**
     * each answer belong to one question
     */
    public function question()
    {
        return $this->belongsTo('Question', 'question_id');
    }
    

    
}

