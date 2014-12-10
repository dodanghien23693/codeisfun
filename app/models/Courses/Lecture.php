<?php
use LaravelBook\Ardent\Ardent;

class Lecture extends Ardent{
    
    protected $table = "lectures";
    
    protected $fillable = array('name','order_of_lecture','description');
    
    //protected fields : id, course_id
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      
    );
    
    /**
     * each lecture belong to one chapter
     */
    public function course()
    {
        return $this->belongsTo('Chapter', 'chapter_id');
    }
    
    /**
     * each lecture has many resources
     */
    public function resources()
    {
        return $this->hasMany('Resource','lecture_id');
    }

    /**
     * each lecture of course has many view by user take part in that course
     */
    public function historyViews()
    {
        return $this->hasMany('LectureViewed');
    }
    
    public function chapter()
    {
        return $this->belongsTo('Chapter', 'chapter_id');
    }
    

    public function delete()
    {
        
        $resources = $this->resources;
        foreach($resources as $resource){
          FileController::deleteFile($resource['path']);
        }

        $this->resources()->delete();
        return parent::delete();
    }


}