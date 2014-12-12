<?php

class Notification extends Eloquent{
    
    PUBLIC STATIC $MODEL_TYPE_POST = 1;
    PUBLIC STATIC $MODEL_TYPE_COURSE = 2;
    PUBLIC STATIC $MODEL_TYPE_CHAPTER = 3;
    PUBLIC STATIC $MODEL_TYPE_LECTURE = 4;
    PUBLIC STATIC $MODEL_TYPE_QUIZ = 5;
    PUBLIC STATIC $MODEL_TYPE_QUESTION = 6;
    PUBLIC STATIC $MODEL_TYPE_USER = 7;
    PUBLIC STATIC $MODEL_TYPE_COMMENT = 8;
 
    
    protected $table = "notifications";
    
    protected $fillable = array('description','link');
             


    
    /* user
     * 
     */
    public function user(){
        return $this->belongsToMany("User",'user_notification','notification_id','user_id');
    }
    
    /* type
     * 
     */
    public function type(){
        return $this->belongsTo("TypeNotification", "type_notification_id");
    }

    
    public static function createNew($description,$type_notification_id,$link=null,$model_type = null,$model_id = null)
    {
        $noti = new Notification();
        $noti->description = $description;
        $noti->type_notification_id = $type_notification_id;
        if($link) $noti->link = $link;
        if($model_type) $noti->model_type = $model_type;
        if($model_id) $noti->model_id = $model_id;
        if($noti->save()) return $noti;
        else return false;
    }
    
    
    public static function addOrUpdate($user ,$notification)
    {
        $exits = $user->notifications()->wherePivot('is_read', '=', 0)
                ->where('notifications.model_id','=',$notification['model_id'])
                ->where('notifications.model_type','=',$notification['model_type'])->get(array('notifications.id'))->lists('id');
        
        if(count($exits)) //update time of user_notification
        {
            
            dd($exits);
        }
        else
        {
            $noti = new Notification($notification);
            $user->notifications()->save($noti);
            return $noti;
        }
    }
    
}