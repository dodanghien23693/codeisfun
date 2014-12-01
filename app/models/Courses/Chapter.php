<?php
use LaravelBook\Ardent\Ardent;

class Chapter extends Ardent{
    
    protected $table = "chapters";
    
    protected $fillable = array('name','order_of_chapter','description');
    
    //protected fields : id, course_id
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      
    );
    
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
    
    public function delete()
    {
        $this->lectures()->delete();
        return parent::delete();
    }
}