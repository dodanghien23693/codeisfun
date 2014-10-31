<?php
use LaravelBook\Ardent\Ardent;

class ActivityLog extends Ardent{
    
    protected $table = "activity_log";
    
    protected $fillable = array('activity','page_url');
    
    //protected fields : id, user_id
    /**
    * Ardent validation rules
    */
    public static $rules = array(
        'activity'      => 'required',
        'page_url'      => 'active_url'
    );
    
    /* user
     * 
     */
    public function user(){
        return $this->belongsTo("User");
    }
    

}