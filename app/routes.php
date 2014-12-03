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


/*
 * 
 */
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


/***
 *  course manager
 */
//view all course
Route::get('admin/course','CourseController@viewAllCourse');


//create new course
Route::get('admin/course/new',function(){
    return View::make('admin.courses.new_course');
});
Route::post('admin/course/new','CourseController@createCourse');


//edit course
Route::get('admin/course/edit/{id}',function($id){
    $course = Course::find($id);
    if($course){
        return View::make('admin.courses.edit_course')->with('course', $course);
    }
    else{
     return Redirect::to('admin/course');
    } 
});
Route::post('admin/course/edit/{id}','CourseController@updateCourse');


//delete course
Route::get('admin/course/delete','CourseController@deleteCourse');

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

//update order of chapter
Route::post('admin/course/update-order-chapter','CourseController@updateOrderOfChapter');

//delete chapter
Route::post('admin/chapter/delete','ChapterController@deleteChapter');

//get edit chapter form
Route::get('admin/chapter/get-edit-chapter-form','ChapterController@getEditChapterForm');


/**
 *  lecture manager
 */
//create new lecture
Route::post('admin/lecture/new', 'LectureController@createLecture');

//delete lecture
Route::post('admin/lecture/delete','LectureController@deleteLecture');

//update order of lecture
Route::post('admin/chapter/update-order-lecture','ChapterController@updateOrderOfLecture');

//get create lecture form
Route::get('admin/lecture/get-create-lecture-form','LectureController@getCreateLectureForm');








Route::group(array('prefix'=>'admin'), function(){
    Route::resource('post', 'PostController');
    Route::resource('user', 'UserController');
    Route::resource('tag', 'TagController');
});



//file manager
Route::get('elfinder', 'Barryvdh\Elfinder\ElfinderController@showIndex');
Route::any('elfinder/connector', 'Barryvdh\Elfinder\ElfinderController@showConnector');
Route::get('elfinder/tinymce', 'Barryvdh\Elfinder\ElfinderController@showTinyMCE4');