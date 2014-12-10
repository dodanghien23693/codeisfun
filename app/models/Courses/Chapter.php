<?php

class Chapter extends Eloquent{
    
    protected $table = "chapters";
    
    protected $fillable = array('name','order_of_chapter','description','user_id');
    
    //protected fields : id, course_id
    
    /**
    * Ardent validation rules
    */

    /**
     * each chapter belong to one course
     */
    public function course()
    {
        return $this->belongsTo('Course', 'course_id');
    }
    
    /**
     * each chapter has many lectures
     */
    public function lectures()
    {
        return $this->hasMany('Lecture', 'chapter_id');
    }

    public static function getList($course_id)
    {
        
        $chapters = Chapter::where('course_id','=',$course_id)->orderBy('order_of_chapter')->get(array('id','order_of_chapter','name','description'))->toArray();
        return $chapters;
    }
    
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }
    
    public function delete()
    {
        $this->lectures()->delete();
        
        return parent::delete();
    }
    
    
}