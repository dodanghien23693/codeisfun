<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Course extends Eloquent{
    
    use SoftDeletingTrait;
    
    protected $table = "courses";
    protected $dates = ['deleted_at'];
    protected $fillable = array('name','short_name','start_day','end_day','about_the_course','cost','deleted_at');
    
    //protected fileds : id
    
    
    
    
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
    
    public function owner()
    {
        return $this->instructors()->wherePivot('is_owner', '=', 1)->first();
        return null;
    }
    
    public function delete()
    {
        $this->categories()->detach();
        $this->instructors()->detach();
        FileController::deleteFile($this->cover_image_url);
        $chapters = $this->chapters();
        foreach($chapters as $chapter){
            $chapter->delete();
        }
        
        return parent::delete();
    }
    
}

