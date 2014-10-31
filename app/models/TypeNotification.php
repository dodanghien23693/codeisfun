<?php

use LaravelBook\Ardent\Ardent;

class TypeNotification extends Ardent{
    
    protected $table = "type_notification";
    
    protected $fillable = array('name');
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      
    );
    
    /* notifications
     * 
     */
    public function notifications(){
        return $this->hasMany("Notification", "type_id");
    }

}
