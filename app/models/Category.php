<?php
use LaravelBook\Ardent\Ardent;

class Category extends Ardent{
    
    protected $table = "categories";
    
    protected $fillable = array('name','description','image_url','parent_category_id','order_of_category');
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      'name'        => 'required',
        'description' => 'required|min:50',
        'parent_category_id'    => 'required|integer',
        'order_of_category'     => 'integer'
        
    );
    
    
    /* posts
     * 
     */
    public function posts(){
        return $this->belongsToMany("Post", "post_category");
    }
    
    
    /* users
     * 
     */
    public function users(){
        return $this->belongsToMany("User", "user_category");
    }





}