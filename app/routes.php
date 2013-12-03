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

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@showWelcome'));
Route::get('styles', array('as' => 'styles', 'uses' => 'HomeController@showStyles'));

//Route::any("login", [ "as" => "user/login", "uses" => "UserController@loginAction" ]);
Route::get('login', array('as'=>'login', 'uses'=>'UserController@getLogin'));
Route::post('login', array('before'=>'csrf', 'uses'=>'UserController@postLogin'));
Route::get('logout', array('as'=>'logout', 'uses'=>'UserController@getLogout'));

Route::get('users', array('as'=>'users', 'uses'=>'UserController@listUsers'));
Route::any('user_create', array('as' => 'user_create', 'uses' => 'UserController@createUser'));
Route::get('user_edit/{id}', array('uses' => 'UserController@getEditUser'))->where('id', '[0-9]+');
Route::post('user_edit_post', array('as' => 'user_edit_post', 'before' => 'csrf', 'uses' => 'UserController@postEditUser'));
Route::any('user_delete/{id}', array('uses' => 'UserController@deleteUser'))->where('id', '[0-9]+');

Route::any('role/index', array('as' => 'role/index', 'uses' => 'RoleController@indexAction'));
Route::any('role/edit/{id}', array('uses' => 'RoleController@editAction'));

Route::group(array("before" => "auth"), function()
    {
        Route::get('profile', array('as'=>'profile', 'uses'=>'UserController@getProfile'));
        Route::any('profile_edit', array('as'=>'profile_edit', 'uses'=>'UserController@editProfile'));
    });
