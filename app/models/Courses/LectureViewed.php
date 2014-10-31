<?php

use LaravelBook\Ardent\Ardent;

class LectureViewed extends Ardent{
    
    protected $table = "lecture_viewed";
    
    protected $fillable = array('date_viewed');
    
    //protected fields : id, user_course_id, lecture_id
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      
    );
    
    /**
     * each lecture_viewed belong to one lecture
     */
    public function lecture()
    {
        return $this->belongsTo('Lecture', 'lecture_id');
    }
    
    /**
     * each lecture_viewed belong to one user
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    
}
