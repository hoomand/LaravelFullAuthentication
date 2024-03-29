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
Route::get('404', array('as' => '404', 'uses' => 'HomeController@show404'));

Route::get('login', array('as'=>'login', 'uses'=>'UserController@getLogin'));
Route::any('password/request', array('as'=>'password/request', 'uses'=>'UserController@requestAction'));
Route::any('password/reset/{token}', array('as'=>'password/reset', 'uses'=>'UserController@resetAction'));
Route::post('login', array('before'=>'csrf', 'uses'=>'UserController@postLogin'));
Route::get('logout', array('as'=>'logout', 'uses'=>'UserController@getLogout'));

Route::group(array("before" => "auth"), function()
    {
        Route::get('user/profile', array('as'=>'user/profile', 'before' => 'allowed:profile_view', 'uses'=>'UserController@profileAction'));
        Route::any('user/profile/edit/password', array('as'=>'user.profile.edit.password', 'before' => 'allowed:profile_edit_password', 'uses'=>'UserController@editProfilePasswordAction'));
        Route::any('user/profile/edit', array('as'=>'user/profile/edit', 'before' => 'allowed:profile_edit', 'uses'=>'UserController@editProfileAction'));

        Route::get('user/index', array('as'=>'user/index', 'before' => 'allowed:users_view', 'uses'=>'UserController@indexAction'));
        Route::any('user/create', array('before' => 'allowed:users_create', 'as' => 'user/create', 'uses' => 'UserController@createAction'));
        Route::any('user/edit/{id}', array('as' => 'user.edit', 'before' => 'allowed:users_edit', 'uses' => 'UserController@editAction'))->where('id', '[0-9]+');
        Route::any('user/edit/password/{id}', array('before' => 'allowed:users_edit_password', 'as' => 'user.edit.password', 'uses' => 'UserController@editPasswordAction'))->where('id', '[0-9]+');
        Route::post('user/edit/roles/{id}', array('as' => 'user.edit.roles', 'before' => 'csrf|allowed:roles_edit', 'uses' => 'UserController@editRole'))->where('id', '[0-9]+');
        Route::any('user/delete/{id}', array('before' => 'allowed:users_delete', 'uses' => 'UserController@deleteAction'))->where('id', '[0-9]+');

        Route::any('role/index', array('as' => 'role/index', 'before' => 'allowed:roles_view', 'uses' => 'RoleController@indexAction'));
        Route::any('role/create', array('as' => 'role/create', 'before' => 'allowed:roles_create', 'uses' => 'RoleController@createAction'));
        Route::get('role/edit/{id}', array('before' => 'allowed:roles_edit', 'uses' => 'RoleController@editAction'));
        Route::post('role/edit/{id}', array('before' => 'csrf|allowed:roles_edit', 'uses' => 'RoleController@editAction'));
        Route::post('role/edit/perms/{id}', array('before' => 'csrf|allowed:roles_edit', 'uses' => 'RoleController@editPermission'));
        Route::get('role/delete/{id}', array('before' => 'allowed:roles_delete', 'uses' => 'RoleController@deleteAction'))->where('id', '[0-9]+');
        Route::post('role/delete/{id}', array('before' => 'csrf|allowed:roles_delete', 'uses' => 'RoleController@deleteAction'))->where('id', '[0-9]+');

   });
