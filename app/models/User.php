<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;


class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $fillable = array ('username','email','first_name',
        'last_name','gender','birthday','about_me','facebook_link',
        'googleplus_link','twitter_link','website_url','photo_url','user_type') ;

    //protected fields: password,  role_id, created_at, updated_at
    
    protected $hidden = array();


    // Loại bỏ trường password_confirmation khỏi csdl
    //public $autoPurgeRedundantAttributes = true;  
    
    

    /**
     * Ardent validation rules
     */



    public static $rules = array(
        'username'      => 'required|min:4|max:50|unique:users,username|alpha_dash',
        'email'         => 'required|unique:users,email',
        'password'      => 'required',
        'first_name'    => 'required|between:2,30',
        'last_name'     => 'required|between:2,30',
        'gender'        => 'in:male,female',
        'facebook_link' => 'url',
        'googleplus_link' => 'url',
        'twitter_link'  => 'active_url',
        'website_url'   => 'active_url',
        'user_type'     => 'in:codeisfun,facebook,google'
        
        
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

    
    public function chapters()
    {
        return $this->hasMany('Chapter', 'user_id');
    }
    
    /* Writer_Category
     * Một người dùng có thể được phân quyền thuộc nhiều category thông quảng bảng Writer_Category . 
     */

    public function categories()
    {
        return $this->belongsToMany("Category", "user_category");
    }

    
    public function hasRole($value){
        

        return ($this->role()->first()->name == $value)?true:false;
    }
    
    public function hasRoles($roles){
        foreach ($roles as $role)
        {
            if($this->hasRole($role)) return true;
        }
        return false;
        
    }
    
    /** Role
     * 
     */
    public function role()
    {
        return $this->belongsTo("Role",'role_id');
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

    public function createdCourses()
    {
        return $this->belongsToMany("Course", "course_instructor");
    }

    public function joinedCourses()
    {
        return $this->belongsToMany('Course', 'user_course', 'user_id');
    }
    
    public function createdCoursesWithTrashed()
    {
        return $this->belongsToMany("Course", "course_instructor")->withTrashed();
    }
    
    public function isOwnerOfCourse($course_id)
    {
        $course = $this->createdCoursesWithTrashed()->wherePivot('course_id', '=', $course_id)->wherePivot('is_owner', '=', 1)->first();      
        //$course = Course::withTrashed()->find($course_id);
        //$user = $course->instructors()->wherePivot('is_owner', '=', 1)->first();
        if($course)
        {
            return true;
        }
        else{
            return false;
        }
    }
    
    
    //Người dùng chỉ có quyền edit course khi : 
    //- course tồn tại và không ở trong thùng rác, 
    //- người đó là chủ hoặc người cùng tham gia tạo course
    public function isEditableOfCourse($course_id)
    {
        $course = $this->createdCourses()->wherePivot('course_id', '=', $course_id)->first();      
        //$course = Course::withTrashed()->find($course_id);
        //$user = $course->instructors()->wherePivot('is_owner', '=', 1)->first();
        if($course)
        {
            return true;
        }
        else{
            return false;
        }
    }
    
    public function isUser()
    {
        return ($this->role_id == 1);
    }
    
    public function isWriter()
    {
        return ($this->role_id == 2);
    }
    
    public function isManager()
    {
        return ($this->role_id == 3);
    }
    public function isAdmin()
    {
        return ($this->role_id == 4);
    }
    
    public static function writers()
    {
        return User::where('role_id','=',2)->get();
    }
    
    public static function managers()
    {
        return User::where('role_id','=',3)->get();
    }
    
    public static function users()
    {
        return User::where('role_id','=',1)->get();
    }


    public function isOwnerOfChapter($chapter_id)
    {
        return $this->id == Chapter::find($chapter_id)->user_id;
    }
    
    public function isOwnerOfQuiz($quiz_id)
    {
        return $this->id == Quiz::find($quiz_id)->user_id;
    }
    
    /**
     * 
     */

}
