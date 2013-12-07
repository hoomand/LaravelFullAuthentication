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

Route::get('login', array('as'=>'login', 'uses'=>'UserController@getLogin'));
Route::post('login', array('before'=>'csrf', 'uses'=>'UserController@postLogin'));
Route::get('logout', array('as'=>'logout', 'uses'=>'UserController@getLogout'));

Route::get('user/index', array('as'=>'user/index', 'uses'=>'UserController@indexAction'));
Route::any('user/create', array('as' => 'user/create', 'uses' => 'UserController@createAction'));
Route::get('user/edit/{id}', array('uses' => 'UserController@editAction'))->where('id', '[0-9]+');
Route::post('user/edit/{id}', array('before' => 'csrf', 'uses' => 'UserController@editAction'))->where('id', '[0-9]+');
Route::any('user/delete/{id}', array('uses' => 'UserController@deleteAction'))->where('id', '[0-9]+');

Route::any('role/index', array('as' => 'role/index', 'uses' => 'RoleController@indexAction'));
Route::any('role/edit/{id}', array('uses' => 'RoleController@editAction'));
Route::any('role/edit/perms/{id}', array('uses' => 'RoleController@editPermission'));

Route::group(array("before" => "auth"), function()
    {
        Route::get('profile', array('as'=>'profile', 'uses'=>'UserController@getProfile'));
        Route::any('profile_edit', array('as'=>'profile_edit', 'uses'=>'UserController@editProfile'));
    });
