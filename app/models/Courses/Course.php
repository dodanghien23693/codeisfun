<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Course extends Eloquent{
    
    use SoftDeletingTrait;
    
    protected $table = "courses";
    protected $dates = ['deleted_at'];
    protected $fillable = array('name','short_name','start_day','end_day','about_the_course','cost','deleted_at');
    
    //protected fileds : id
    
    
    
    
    /**
     * belong to many Categories via course_category
     */
    public function categories()
    {
        return $this->belongsToMany('Category', 'course_category');
    }
    
    /**
     * each course has many chapters
     */
    public function chapters()
    {
        return $this->hasMany('Chapter');    
    }
    
    /**
     * each course has many quizzes
     */
    public function quizzes()
    {
        return $this->hasMany('Quiz');
    }
    
    /**
     * belong to many users via user_course table
     */
    public function users()
    {
        return $this->belongsToMany('User', 'user_course');
    }
    
    /**
     * each course has many FAQ
     */
    public function faqs()
    {
        return $this->hasMany('CourseFAQ');
    }

    /**
     * each course has many Instructor via course_instructor table
     */
    public function instructors()
    {
        return $this->belongsToMany('User', 'course_instructor');
    }
    
    public function owner()
    {
        return $this->instructors()->wherePivot('is_owner', '=', 1)->first();
        return null;
    }
    
    public function forceDeletedelete()
    {
        $this->categories()->detach();
        $this->instructors()->detach();
        FileController::deleteFile($this->cover_image_url);
        $chapters = $this->chapters();
        foreach($chapters as $chapter){
            $chapter->delete();
        }
        
        return parent::delete();
    }
    
    
    public function getLink()
    {
        return action('CourseController@index',array('course_id'=>$this->id));  
    }
    
    
    public function notificationUpdate()
    {
        $noti = Notification::findNotification(Notification::$MODEL_TYPE_COURSE, $this->id);
        if($noti)
        {
            $noti->touch();
        }
        else
        {
            $noti = Notification::createNew(
                Auth::user()->username.' had updated course '.$this->name, 
                TypeNotification::$TYPE_NOTIFICATION_UPDATE,
                '',
                Notification::$MODEL_TYPE_COURSE, 
                $this->id
                );
            
            $instructors = $this->instructors()->wherePivot('user_id', '!=', Auth::id())->get(array('users.id'))->lists('id');
            if(count($instructors))
            {
                $hasNew = false;
                $user = User::find($intr);
                foreach($instructors as $intr)
                {
                    if(Notification::attachOrTouchIfUnread($user, $noti)) $hasNew = true;
                }
                if(!$hasNew) $noti->delete ();

                //$noti->user()->attach($instructors);
            }
        }
        $notification = array(
            'description' => Auth::user()->username.' had updated course '.$this->name, 
            'type_notification_id' => TypeNotification::$TYPE_NOTIFICATION_UPDATE,
            'link'  => '',
            'model_type' => Notification::$MODEL_TYPE_COURSE,
            'model_id' => $this->id
        );
        
    }
    
    
    
    public function notificationInviteWriter($user_id)
    {
        $noti = Notification::createNew(Auth::user()->username.' send you request to become creator of course:'. $this->name, 
                TypeNotification::$TYPE_NOTIFICATION_PEDDING,
                action('CourseController@getAcceptBecomeCreator', array('course_id'=>$this->id)),
                Notification::$MODEL_TYPE_COURSE, 
                $this->id);
        $noti->user()->attach($user_id);  
    }
    
    public function notificationRemoveWriter($user_id)
    {
        $noti = Notification::createNew(Auth::user()->username.' remove you out of creator of course:'. $this->name, 
                TypeNotification::$TYPE_NOTIFICATION_DELETE,
                $this->getLink(),
                Notification::$MODEL_TYPE_COURSE, 
                $this->id);
        $noti->user()->attach($user_id);  
    }

}

