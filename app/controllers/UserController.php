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

            $rules = array(
                'email' => 'required|email',
                'gender' => 'required|in:male,female',
                'first_name' => 'required|alpha_space',
                'last_name' => 'required|alpha_space'
            );
            $validation = Validator::make(Input::all(), $rules);

            if ($validation->fails())
                return Redirect::back()->withErrors($validation)->withInput();

            User::where('id','=',Auth::user()->id)->update(array(
                'first_name' => Input::get('first_name'),
                'last_name' => Input::get('last_name'),
                'email' => Input::get('email'),
                'phone' => Input::get('phone'),
                'cellphone' => Input::get('cellphone'),
                'gender' => Input::get('gender')
            ));

            return Redirect::route('profile')->with('success', 'Profile info successfully updated');


        }
        return View::make('user.profile_edit');
    }

    public function listUsers()
    {
        $users = User::all();
        return View::make('user.list')->with('users',$users);
    }

    public function getEditUser($user_id)
    {
        $user = User::find($user_id);
        return View::make('user.user_edit')->with('user', $user);
    }

}
