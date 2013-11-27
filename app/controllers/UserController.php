<?php

class UserController extends BaseController {

    public function postLogin()
    {
	$user = array(
		'username' => Input::get('username'),
		'password' => Input::get('password')
	);

	if (Auth::attempt($user)) {
		return Redirect::route('home')->with('success', 'You are logged in');
	} else {
		return Redirect::route('login')
			->withErrors('Your credentials are incorrect')
			->withInput();
	}
    }
    public function getLogin()
    {
	return View::make('user.login');
    }

    public function getLogout()
    {
	if (Auth::check()) {
		Auth::logout();
		return Redirect::route('login')->with('success', 'You have just logged out');
        }
    }

    public function getProfile()
    {
        return View::make('user.profile');
    }
    public function editProfile()
    {
        if (Input::server("REQUEST_METHOD") == "POST")
        {

        }
        return View::make('user.profile_edit');
    }



}
