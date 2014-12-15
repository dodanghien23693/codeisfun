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

    /**
     * 
     * @param type $description
     * @param type $type_notification_id
     * @param type $link
     * @param type $model_type
     * @param type $model_id
     * @return boolean|\Notification
     */
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
    
    /**
     * 
     * @param type \User
     * @param type \Notification
     * @return \Notification
     */
    public static function attachOrTouchIfUnread($user ,$notification)
    {
        $exits = $user->notifications()->wherePivot('is_read', '=', 0)
                ->where('notifications.model_id','=',$notification->model_id)
                ->where('notifications.model_type','=',$notification->model_type)->get(array('notifications.id'))->lists('id');
        
        if(count($exits)) //update time of user_notification  touch
        {
            
            //$user->notifications()->wherePivot('no')
            return false;
        }
        else //attach
        {
           // $noti = new Notification($notification);
            $user->notifications()->attach($notification->id);
            return true;
        }
    }
    
    /**
     * 
     * @param type $model_type
     * @param type $model_id
     * @return \Notification
     */
    public static function findNotification($model_type, $model_id)
    {
        $noti = Notification::where('model_type','=',$model_type)->where('model_id', '=', $model_id)->first();
        if(count($noti)) return $noti;
        else return null;
    }
    
    
    
    public static function getNotifications()
    {
    
        $notifications = Auth::user()->notifications()->orderBy('updated_at')->get(array('description','link','user_notification.is_read','user_notification.is_old','notifications.updated_at','model_type','model_id','type_notification_id'));

        if(Request::ajax()){
            return Response::json(array(
                'last_update' => $notifications[count($notifications)-1]->updated_at,
                'number_new_notis' => User::find($user_id)->notifications()->wherePivot('is_old', '=', 0)->get()->count(),
                'notifications' => convertNotifications($notifications)
            ));
        }
        else  return json_encode($notifications[count($notifications)-1]->updated_at);

    }
    
    public static function getNewNotifications(){
        $last_update = Input::get('last_update');
        $notifications = Auth::user()->notifications()->where('notifications.updated_at','>',$last_update)->orderBy('updated_at')->get(array('description','link','user_notification.is_read','user_notification.is_old','notifications.updated_at','model_type','model_id','type_notification_id'));

            if(Request::ajax()){
                return Response::json(array(
                    'last_update' => $notifications[count($notifications)-1]->updated_at,
                    'new_notifications' => convertNotifications($notifications)
                ));
            }
            else  return json_encode($notifications[count($notifications)-1]->updated_at);
        }

    public static function time2str($ts)
    {
        if(!ctype_digit($ts))
            $ts = strtotime($ts);

        $diff = time() - $ts;
        if($diff == 0)
            return 'now';
        elseif($diff > 0)
        {
            $day_diff = floor($diff / 86400);
            if($day_diff == 0)
            {
                if($diff < 60) return 'just now';
                if($diff < 120) return '1 minute ago';
                if($diff < 3600) return floor($diff / 60) . ' minutes ago';
                if($diff < 7200) return '1 hour ago';
                if($diff < 86400) return floor($diff / 3600) . ' hours ago';
            }
            if($day_diff == 1) return 'Yesterday';
            if($day_diff < 7) return $day_diff . ' days ago';
            if($day_diff < 31) return ceil($day_diff / 7) . ' weeks ago';
            if($day_diff < 60) return 'last month';
            return date('F Y', $ts);
        }
        else
        {
            $diff = abs($diff);
            $day_diff = floor($diff / 86400);
            if($day_diff == 0)
            {
                if($diff < 120) return 'in a minute';
                if($diff < 3600) return 'in ' . floor($diff / 60) . ' minutes';
                if($diff < 7200) return 'in an hour';
                if($diff < 86400) return 'in ' . floor($diff / 3600) . ' hours';
            }
            if($day_diff == 1) return 'Tomorrow';
            if($day_diff < 4) return date('l', $ts);
            if($day_diff < 7 + (7 - date('w'))) return 'next week';
            if(ceil($day_diff / 7) < 4) return 'in ' . ceil($day_diff / 7) . ' weeks';
            if(date('n', $ts) == date('n') + 1) return 'next month';
            return date('F Y', $ts);
        }
    }
    
    public static function convertNotifications($notifications)
    {
        $notis = array();
            foreach($notifications as $noti)
            {
                array_push($notis, [
                    'description'=>$noti->description,
                    'link'      => $noti->link,
                    'type_notification_id' => $noti->type_notification_id,
                    'period'    => Notification::time2str($noti->updated_at),
                    'class_icon' => TypeNotification::$class_icon[$noti->type_notification_id],
                    'class_notification' => TypeNotification::$class_notification[$noti->type_notification_id],
                    'is_read'   => $noti->is_read,
                    'is_old'    => $noti->is_old
                   ]);
            }
         return $notis;   
    }
    

}