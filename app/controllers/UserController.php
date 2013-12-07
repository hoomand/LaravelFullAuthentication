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
            $validation = User::validate_update(Input::all());

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

    public function indexAction()
    {
        $users = User::all();
        return View::make('user.index')->with('users',$users);
    }

    public function createAction()
    {
        if (Input::server("REQUEST_METHOD") == "POST")
        {
            $validation = User::validate_create(Input::all());
            if ($validation->fails())
                return Redirect::back()->withErrors($validation)->withInput();

            $user = new User;
            $user->username = Input::get('username');
            $user->first_name = Input::get('first_name');
            $user->last_name = Input::get('last_name');
            $user->password = Hash::make(Input::get('password'));
            $user->email = Input::get('email');
            $user->gender = Input::get('gender');
            $user->phone = Input::get('phone');
            $user->cellphone = Input::get('cellphone');

            $user->save();
            return Redirect::route('user/index')->with('success', 'New user ' . $user->getFullNameWithUsername() . ' got created');
        }
        return View::make('user.create');
    }

    public function editAction($user_id)
    {
        if (Input::server("REQUEST_METHOD") == "POST")
        {
            $validation = User::validate_update(Input::all());
            if ($validation->fails())
                return Redirect::back()->withErrors($validation)->withInput();

            User::where('id','=',$user_id)->update(array(
                'first_name' => Input::get('first_name'),
                'last_name' => Input::get('last_name'),
                'email' => Input::get('email'),
                'phone' => Input::get('phone'),
                'cellphone' => Input::get('cellphone'),
                'gender' => Input::get('gender')
            ));

            return Redirect::route('user/index')->with('success', 'User info successfully updated');
        }

        $user_roles = User::find($user_id)->roles;
        $user_role_ids = array();
        foreach ($user_roles as $ur)
            array_push($user_role_ids, $ur->id);

        return View::make('user.edit')
            ->with('user', User::find($user_id))
            ->with('all_roles', Role::all())
            ->with('user_role_ids', $user_role_ids);
    }

    public function editRole($user_id)
    {
        # Delete all user roles first
        User::find($user_id)->roles()->detach();
        if (Input::has('roles'))
        {
            User::find($user_id)->roles()->sync(Input::get('roles'));
        }

        return Redirect::back()->with('success', 'Roles got updated successfully');

    }

    public function deleteAction($user_id)
    {
        $user = User::find($user_id);
        if (Input::server("REQUEST_METHOD") == "POST")
        {
            $user->delete();
            return Redirect::route('user/index')->with('success', 'User ' . $user->getFullNameWithUsername() . ' got deleted');
        }
        return View::make('user.delete')->with('user', $user);
    }
}
