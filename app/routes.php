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

Route::get('/', function()
{
    
    
    return "Xin chao";
});


// authentication
//login with facebook and google
 Route::get('facebook', array('as' => 'facebook', 'uses' => 'AuthController@loginWithFacebook'));
 Route::get('google', array('as' => 'google', 'uses' => 'AuthController@loginWithGoogle'));

Route::get('login', ['as' => 'login', 'uses' => 'AuthController@getLogin']);
Route::post('login', 'AuthController@login');
Route::get('register',array('as' => 'register', 'uses' => 'AuthController@getRegister') );
Route::post('register', 'AuthController@register');

Route::get('signup-confirm', 'AuthController@getSignupConfirm');
Route::post('signup-confirm', 'AuthController@postSignupConfirm');
Route::get('logout', 'AuthController@logout');
Route::get('oauth', 'AuthController@getOauth');

 