<?php
use LaravelBook\Ardent\Ardent;
class Rating extends Ardent{
    
    protected $table = "ratings";
    
    protected $fillable = array('rating');
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      'rating'      => 'numeric'
    );
    
    /* post
     * 
     */
    public function post(){
        return $this->belongsTo("Post");
    }
    
    /* user
     * 
     */
    public function user(){
        return $this->belongsTo("User");
    }

}
