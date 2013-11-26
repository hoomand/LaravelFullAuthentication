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

Route::get('profile', array('as'=>'profile', 'uses'=>'UserController@getProfile'));
