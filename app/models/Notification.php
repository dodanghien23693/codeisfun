<?php
use LaravelBook\Ardent\Ardent;

class Notification extends Ardent{
    
    protected $table = "notifications";
    
    protected $fillable = array('description','is_read');
             
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      'description'     => 'required|max:300',
        'is_read'       => 'required|boolean'
    );
    
    /* user
     * 
     */
    public function user(){
        return $this->belongsTo("User");
    }
    
    /* type
     * 
     */
    public function type(){
        return $this->belongsTo("TypeNotification", "type_id");
    }

}