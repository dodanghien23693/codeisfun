<?php


class TypeNotification extends Eloquent{
    
    PUBLIC STATIC $TYPE_NOTIFICATION_NEW = 1;
    PUBLIC STATIC $TYPE_NOTIFICATION_UPDATE = 2;
    PUBLIC STATIC $TYPE_NOTIFICATION_DELETE = 3;
    PUBLIC STATIC $TYPE_NOTIFICATION_PEDDING = 4;
    PUBLIC STATIC $TYPE_NOTIFICATION_INVALID = 5;
    PUBLIC STATIC $TYPE_NOTIFICATION_INFO = 6;
    

    public static $class_icon = array(
        0 => '',
        1=>'entypo-plus-circled',
        2=>'entypo-pencil',
        3=>'entypo-cancel-circled',
        4=>'entypo-retweet',
        5=>'entypo-attention',
        6=>'entypo-info',
        );
    
    public static $class_notification= array(
        0 => '',
        1=>'notification-success',
        2=>'notification-secondary',
        3=>'notification-danger',
        4=>'notification-primary',
        5=>'notification-warning',
        6=>'notification-info',
        );
    
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
