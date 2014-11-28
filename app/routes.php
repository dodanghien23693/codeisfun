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

// posts
Route::resource('post', 'PostController');

Route::get('elfinder', 'Barryvdh\Elfinder\ElfinderController@showIndex');
Route::any('elfinder/connector', 'Barryvdh\Elfinder\ElfinderController@showConnector');
Route::get('elfinder/tinymce', 'Barryvdh\Elfinder\ElfinderController@showTinyMCE4');

//ajax in polymer
Route::post('getuser','UserController@getUser');
Route::get('getuser','UserController@index');

//