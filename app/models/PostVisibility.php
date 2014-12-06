<?php
use LaravelBook\Ardent\Ardent;

class PostVisibility extends Ardent{
    
    protected $table = "post_visibility";
    
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
        return $this->hasMany("Post", "visibility_id");
    }

}