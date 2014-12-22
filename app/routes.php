<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 *  get notification
 */

Route::get('admin/get-comment',function(){
    /*
   for($i=0;$i<10;$i++)
   {
       Auth::user()->comments()->save(new Comment(array('content'=>'comment thu '.$i,'commentable_type'=>'Post','commentable_id'=>1)));
   }
     * 
     */
    
    $comments = Auth::user()->comments()->get();
    //return var_dump($comments);
    return View::make('admin.comments._comment')->with('comments', $comments);
});


Route::get('admin/notification',function(){
    
    $notifications = Auth::user()->notifications()->orderBy('notifications.updated_at')->limit(10)->get(array('description','link','user_notification.is_read','user_notification.is_old','notifications.updated_at','model_type','model_id','type_notification_id'));
    
    
    if(count($notifications))
    {
        if(Request::ajax()){
            return Response::json(array(
                'last_update' => $notifications[count($notifications)-1]->updated_at,
                'number_new_notis' => Auth::user()->notifications()->wherePivot('is_old', '=', 0)->get()->count(),
                'notifications' => Notification::convertNotifications($notifications)
            ));
        }
        
    }
    else
    {
        return Response::json(array(
                'last_update' => DateTime::getTimestamp(),
                'number_new_notis' => 0,
                'notifications' => array()
        ));
    }
    
    

});

Route::get('admin/notification/get-new',function(){
    
    $last_update = Input::get('last_update');
    $notifications = Auth::user()->notifications()->where('notifications.updated_at','>',$last_update)->orderBy('notifications.updated_at')->get(array('description','link','user_notification.is_read','user_notification.is_old','notifications.updated_at','model_type','model_id','type_notification_id'));
    if(count($notifications))
    {
        if(Request::ajax()){
            return Response::json(array(
                'last_update' => $notifications[count($notifications)-1]->updated_at,
                'new_notifications' => Notification::convertNotifications($notifications)
            ));
        }
        else  return json_encode($notifications[count($notifications)-1]->updated_at);
    }

    });
    
Route::post('admin/notification/set-old',function(){
    
    $last_update = Input::get('last_update');
    if($last_update)
    {
        $notis = Auth::user()->notifications()->where('notifications.updated_at','<=',$last_update)->wherePivot('is_old','=',0)->get(array('notifications.id'));
        
        
        $user = Auth::user();
        foreach ($notis as $noti)
        {
            $user->notifications()->updateExistingPivot($noti->id, array('is_old'=>1));
        }

        
        return 'updated successfull';
        
        return json_encode($notis);
    }
});


Route::post('admin/notification/mark-all-read',function(){
    $last_update = Input::get('last_update');
    if($last_update)
    {
        $notis = Auth::user()->notifications()->where('notifications.updated_at','<=',$last_update)->wherePivot('is_read','=',0)->get(array('notifications.id'));
        
        $user = Auth::user();
        foreach ($notis as $noti)
        {
            $user->notifications()->updateExistingPivot($noti->id, array('is_read'=>1));
        }

        return 'updated successfull';
        
        //return json_encode($notis);
    }
        
});

Route::post('admin/course/{id}/accept-invite', 'CourseController@acceptInvitation');
Route::post('admin/course/{id}/reject-invite', 'CourseController@rejectInvitation');
Route::get('admin/course/{id}/accept', 'CourseController@acceptInvitation');



Route::get('login-as/{username}',function($username){
    Auth::attempt(array('username'=>$username,'password'=>$username));
    if(Auth::check()){
        $message = '';
        if(Auth::user()->isManager()){
            $list = '';
            foreach(Auth::user()->categories as $category)
            {
                $list .= $category->name.', ';
            }
            $message = 'có quyền quản lý đối với các danh mục: '.$list;         
        }
        if(Auth::user()->isWriter()){
            $list = '';
            foreach(Auth::user()->categories as $category)
            {
                $list .= $category->name .', ';
            }
            $message = 'có quyền viết bài đối với các danh mục: '.$list;         
        }

        return '<p>Bạn đã đăng nhập bằng tài khoản:'.Auth::user()->username.'</p>'.
                $message;
               
    }
});


Route::get('/', array('as'=>'home','uses'=>function()
{
    return View::make('public.index');
}));


Route::group(array('before' => 'auth'), function(){
      
    Route::get('logout',array('as'=>'logout','uses'=> 'AuthController@logout'));
});


Route::get('oauth', 'AuthController@getOauth');


// authentication guest
Route::group(array('before'=>'guest'), function(){
    
    //Đăng ký tài khoản
 Route::get('register',array('before'=>'guest','as' => 'register', 'uses' => 'AuthController@getRegister') );
 Route::post('register', 'AuthController@register');
    
//login with facebook and google
 Route::get('facebook', array('as' => 'facebook', 'uses' => 'AuthController@loginWithFacebook'));
 Route::get('google', array('as' => 'google', 'uses' => 'AuthController@loginWithGoogle'));

 //login with codeisfun account
Route::get('login', array('as' => 'login', 'uses' => 'AuthController@getLogin'));
Route::post('login', 'AuthController@login');
    

Route::get('login-required',function(){
    return View::make('public.auth.login-require');
});
    
     //reset password
   Route::get('reset-password',array(
    'as'=>'password.remind',
    'uses'=>'AuthController@remindPassword'));

    Route::post('reset-password', array(
      'uses' => 'AuthController@requestPassword',
      'as' => 'password.request'
    ));

    Route::get('reset-password/{token}', array(
      'uses' => 'AuthController@resetPassword',
      'as' => 'password.reset'
    ));

    Route::post('reset-password/{token}', array(
      'uses' => 'AuthController@updatePassword',
      'as' => 'password.update'
    ));
    // end reset password
    
});


//



Route::group(array('before'=>'auth'), function(){
    
    Route::get('admin', 'AdminController@getIndex');
    Route::get('admin/user/profile',array('as'=>'user-profile','uses' => 'AuthController@getLogin'));
    Route::get('admin/user/profile',array('as'=>'edit-profile','uses' => 'AuthController@getLogin'));


    /**
     *  categories manager
     */

    //get category form
    Route::get('admin/category', 'CategoryController@getCategoryContent');
    Route::post('admin/get-category-content', 'CategoryController@getCategoryContent');
    //update category order
    Route::post('admin/update-order-category','CategoryController@updateOrderCategory');

    //create new category
    Route::post('admin/category/new','CategoryController@createCategory');

    //delete category
    Route::post('admin/category/delete','CategoryController@deleteCategory');

    //get edit category form modal
    Route::get('admin/category/get-edit-category-form','CategoryController@getEditCategoryForm');

    //update category
    Route::post('admin/category/edit/','CategoryController@updateCategory');


    
    /**
     * course public 
     */
    Route::get('course/{id}','CourseController@index');
    Route::get('admin/course/{id}/accept-invitation','CourseController@getAcceptBecomeCreator');
    
    /***
     *  course manager
     */
    //view all course
    Route::get('admin/course','CourseController@viewAllCourse');
    Route::post('admin/course','CourseController@viewAllCourse');


    //create new course
    Route::get('admin/course/new',array('before'=>'managerORwriter','uses'=>'CourseController@getCourseForm'));
    Route::post('admin/course/new','CourseController@createCourse');
    Route::post('admin/course/get-list-chapter','CourseController@getListChapter');
    Route::get('admin/course/get-list-chapter','CourseController@getListChapter');

    //edit course
    Route::get('admin/course/edit/{id}',array('before'=>'managerORwriter','uses'=>'CourseController@getEdit'));

    Route::post('admin/course/edit/{id}',array('before'=>'managerORwriter','uses'=>'CourseController@updateCourse'));


    //delete course
    Route::get('admin/course/delete','CourseController@deleteCourse');


    Route::get('admin/course/destroy/{id}','CourseController@destroy');

    //restore course
    Route::get('admin/course/restore/{id}',function($id){


       $course_trashed = Course::onlyTrashed()->where('id','=',$id)->first();
       $course_trashed->restore();

       return Redirect::to('admin/course');

    });



    /**
     *  chapter manager
     */

    //create new chapter
    Route::post('admin/chapter/new','ChapterController@createChapter');

    Route::get('admin/chapter/new','ChapterController@getCreateChapterForm');

    //update order of chapter
    Route::post('admin/course/update-order-chapter','CourseController@updateOrderOfChapter');

    //delete chapter
    Route::post('admin/chapter/delete','ChapterController@deleteChapter');

    //get edit chapter form
    Route::get('admin/chapter/get-edit-chapter-form','ChapterController@getEditChapterForm');

    Route::get('admin/chapter/create-chapter-form',function(){
        return View::make('admin.courses._create_chapter_form');
    });

    //update chapter
    Route::post('admin/chapter/edit','ChapterController@updateChapter');

    
    /**
     *  lecture manager
     */
    //delete lecture
    Route::post('admin/lecture/delete','LectureController@deleteLecture');

    //update order of lecture
    Route::post('admin/chapter/update-order-lecture','ChapterController@updateOrderOfLecture');


    //get edit lecture form
    Route::get('admin/lecture/get-edit-form','LectureController@getEditForm');

    
    //edit lecture
    Route::post('admin/lecture/edit','LectureController@editLecture');

    Route::post('admin/lecture/add-resource','LectureController@addResource');


    /**
     *  quiz manager
     */

    //edit quiz
    Route::post('admin/quiz/edit','QuizController@editQuiz');


    //update order of chapter
    Route::post('admin/course/update-order-chapter','CourseController@updateOrderOfChapter');

    //delete quiz
    Route::post('admin/quiz/delete','QuizController@deleteQuiz');

    //get edit quiz form
    Route::get('admin/quiz/get-edit-form','QuizController@getEditForm');


    /**
     *  question manager
     */
    //create new question
    Route::post('admin/question/new', 'QuestionController@editQuestion');
    Route::post('admin/question/edit', 'QuestionController@editQuestion');

    //delete question
    Route::post('admin/question/delete','QuestionController@deleteQuestion');

    //update order of question
    Route::post('admin/question/update-order-question','QuestionController@updateOrderOfQuestion');

    //get create question form
    Route::get('admin/question/get-create-question-form','QuestionController@getCreateQuestionForm');

    //get edit question form
    Route::get('admin/question/get-edit-question-form','QuestionController@getEditQuestionForm');



    //get edit form
    Route::get('admin/question/get-edit-form','QuestionController@getEditForm');



    Route::group(array('prefix'=>'admin'), function(){
        Route::resource('post', 'PostController');
        Route::resource('user', 'UserController');
        Route::resource('tag', 'TagController');
    });

});
/*
 * 
 */




//file manager
Route::controller('filemanager', 'FilemanagerLaravelController');

Route::get('file',function(){
    return View::make('file');
});


Route::get('jtable',function(){
    return View::make('jtable');
});
