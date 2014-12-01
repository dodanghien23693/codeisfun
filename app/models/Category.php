<?php
use LaravelBook\Ardent\Ardent;

class Category extends Ardent{
    
    protected $table = "categories";
    
    protected $fillable = array('name','slug','description','image_url','order_of_category');
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
        'name'        => 'required',
        'slug'        => 'required',  
        
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


    public static function getList(){
        
        $categories = Category::orderBy('order_of_category')->get(array('id','order_of_category','name','slug','description'))->toArray();
        
        return $categories;
    }



}