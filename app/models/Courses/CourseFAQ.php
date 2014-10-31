<?php
use LaravelBook\Ardent\Ardent;

class CourseFAQ extends Ardent{
    
    protected $table = "course_faq";
    
    protected $fillable = array('question','answer','date');
    
    //protected fields : id, course_id
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      
    );
    
    /**
     * each course_faq belong to one course
     */
    public function course()
    {
        return $this->belongsTo('Course', 'course_id');
    }
    

    
}

