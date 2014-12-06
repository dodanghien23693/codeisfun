<?php
use LaravelBook\Ardent\Ardent;

class PostStatus extends Ardent{
    
    protected $table = "post_status";
    
    protected $fillable = array('description');
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      'description'     => 'max:200'
    );
    
    /* posts
     * 
     */
    public function posts(){
        return $this->hasMany("Post", "status_id");
    }

}