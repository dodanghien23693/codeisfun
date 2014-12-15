<?php


class CourseInstructor extends Eloquent{
    
    protected $table = "course_instructor";
    
    protected $fillable = array('is_active','is_owner');


    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }
    
    public function course()
    {
        return $this->belongsTo('Course', 'course_id');
    }
    

    
}

