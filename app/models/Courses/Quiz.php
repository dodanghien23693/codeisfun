<?php


class Quiz extends Eloquent{
    
    protected $table = "quizzes";
    
    protected $fillable = array('name','max_attempts','due_date','hard_deadline','duration_minus','user_id');
    
    //protected fields : id, course_id
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      
    );
    
    /**
     * each quiz belong to one course
     */
    public function course()
    {
        return $this->belongsTo('Course', 'course_id');
    }
    
    /**
     * each quiz has many questions
     */
    public function questions()
    {
        return $this->hasMany('Question');
    }

    /**
     * each quiz has many many submited by user via quiz_submit table
     */
    public function submits()
    {
        return $this->hasMany('QuizSubmit');
    }
    
    public function delete()
    {
        $this->questions()->delete();
        return parent::delete();
    }
    
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }
}


