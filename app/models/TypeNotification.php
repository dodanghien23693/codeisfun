<?php


class TypeNotification extends Eloquent{
    
    PUBLIC STATIC $TYPE_NOTIFICATION_NEW = 1;
    PUBLIC STATIC $TYPE_NOTIFICATION_UPDATE = 2;
    PUBLIC STATIC $TYPE_NOTIFICATION_DELETE = 3;
    PUBLIC STATIC $TYPE_NOTIFICATION_PEDDING = 4;
    PUBLIC STATIC $TYPE_NOTIFICATION_INVALID = 5;
    PUBLIC STATIC $TYPE_NOTIFICATION_INFO = 6;
    
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
        return $this->hasMany("Notification", "type_notification_id");
    }

}
