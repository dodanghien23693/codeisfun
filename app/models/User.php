<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;


class User extends Ardent implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $fillable = array ('username','email','password','first_name',
        'last_name','gender','birthday','about_me','facebook_link',
        'googleplus_link','twitter_link','website_url','photo_url','user_type') ;

    //protected fields: password, password_confirmation, role_id, created_at, updated_at
    
    protected $hidden = array();


    // Loại bỏ trường password_confirmation khỏi csdl
    //public $autoPurgeRedundantAttributes = true;  
    
    

    /**
     * Ardent validation rules
     */
    public static $rules = array(
        'username'      => 'required|min:6|max:50',
        'email'         => 'required|email|unique',
        'password'      => '',
        'first_name'    => 'required|between:2,30',
        'last_name'     => 'required|between:2,30',
        'gender'        => 'in:male,female',
        'facebook_link' => 'active_url',
        'googleplus_link' => 'active_url',
        'twitter_link'  => 'active_url',
        'website_url'   => 'active_url'
        
    );

    
    /**
     * 
     * 
     */
    public function posts()
    {
        return $this->hasMany("Post");
    }

    //Comments
    public function comments()
    {
        return $this->hasMany("Comment");
    }

    //Activities
    public function activities()
    {
        return $this->hasMany("Activity");
    }

    /* Writer_Category
     * Một người dùng có thể được phân quyền thuộc nhiều category thông quảng bảng Writer_Category . 
     */

    public function categories()
    {
        return $this->belongsToMany("Category", "user_category");
    }

    /** Role
     * 
     */
    public function role()
    {
        return $this->belongsTo("Role");
    }

    /* Notifications
     * 
     */
    public function notifications()
    {
        return $this->hasMany("Notification");
    }

    /** Subscriptions
     * 
     */
    public function subscriptions()
    {
        return $this->hasMany("Subscription");
    }

    /** Courses
     *  liên kết nhiều nhiều , một người dùng có thể tạo ra nhiều khóa học
     *  thông qua bảng Course_Instructor
     */

    public function courses()
    {
        return $this->belongsToMany("Course", "course_instructor");
    }

    /**
     * 
     */

}
