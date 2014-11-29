<?php

use LaravelBook\Ardent\Ardent;

class Course extends Ardent{
    
    protected $table = "courses";
    
    protected $fillable = array('name','start_day','end_day','about_the_course','cost');
    
    //protected fileds : id
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      
    );
    
    /**
     * belong to many Categories via course_category
     */
    public function categories()
    {
        return $this->belongsToMany('Category', 'course_category');
    }
    
    /**
     * each course has many chapters
     */
    public function chapters()
    {
        return $this->hasMany('Chapter');    
    }
    
    /**
     * each course has many quizzes
     */
    public function quizzes()
    {
        return $this->hasMany('Quiz');
    }
    
    /**
     * belong to many users via user_course table
     */
    public function users()
    {
        return $this->belongsToMany('User', 'user_course');
    }
    
    /**
     * each course has many FAQ
     */
    public function faqs()
    {
        return $this->hasMany('CourseFAQ');
    }

    /**
     * each course has many Instructor via course_instructor table
     */
    public function instructors()
    {
        return $this->belongsToMany('User', 'course_instructor');
    }
    
    
}
