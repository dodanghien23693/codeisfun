<?php
use LaravelBook\Ardent\Ardent;
class Tag extends Ardent{
    
    protected $table = "tags";
    
    protected $fillable = array('name');
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      'name'        => 'required|between:3,50',
       
    );
    
    /* posts
     * 
     */
    public function posts(){
        return $this->belongsToMany("Post", "post_tag");
    }

}

