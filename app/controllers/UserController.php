<?php

class UserController extends BaseController {

    public function postLogin()
    {
        if (!Session::has('user.failed')) {
            Session::put('user.failed', '1');
        } else {
            $failedLogins = (int) Session::get('user.failed');
            $failedLogins += 1;
            Session::put('user.failed', $failedLogins);
        }

        if ( Session::get('user.failed') > 3 )
        {
            $rules =  array('captcha' => array('required', 'captcha'));
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails())
                return Redirect::route('login')->withErrors('Entered code is incorrect');
        }

        $user = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );

        if (Auth::attempt($user)) {
            Session::put('user.failed', '0');
            return Redirect::route('home')->with('success', 'You are logged in');
        } else {
            return Redirect::route('login')
                ->withErrors('Your credentials are incorrect')
                ->with('failedLogins', Session::get('user.failed'))
                ->withInput();
        }
    }
    public function getLogin()
    {
	return View::make('user.login')->with('failedLogins', Session::get('user.failed', 0));
    }

    public function getLogout()
    {
	if (Auth::check()) {
		Auth::logout();
		return Redirect::route('login')->with('success', 'You have just logged out');
        }
        return  Redirect::route('home');
    }

    public function requestAction()
    {
        if (Input::server("REQUEST_METHOD") == "POST")
        {
            $rules = array("email" => "required");
            $validation = Validator::make(Input::all(), $rules);

            if ($validation->fails())
                return Redirect::back()->withErrors($validation)->withInput();

            $credentials = array('email' => Input::get('email'));

            Password::remind(
                $credentials,
                function ($message, $user) {
                    $message->from("info@rasla.com");
                    $message->subject("Password Reset");
                }
            );

            return Redirect::route('password/request')->with('success', 'email was successfully sent');
        }

        return View::make("user.request");
    }

    public function resetAction($token)
    {
        if (Input::server("REQUEST_METHOD") == "POST")
        {
            $rules = array(
                "email" => "required|email",
                "password" => "required|min:6",
                "password_confirmation" => "same:password",
                "token" => "exists:token,token"
            );
            $validation = Validator::make(Input::all(), $rules);
            if ($validation->fails())
                return Redirect::route('password/reset', $token)->withErrors($validation)->withInput();

            $credentials = array('email' => Input::get('email'));
            return Password::reset(
                $credentials,
                function($user, $password) {
                    $user->password = Hash::make($password);
                    $user->save();
                    return Redirect::to('login')->with('success', 'Your password has been reset');
                });
        }

        return View::make('user.reset')->with('token', $token);
    }

    public function profileAction()
    {
        return View::make('user.profile.index');
    }
    public function editProfileAction()
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

            return Redirect::route('user/profile')->with('success', 'Profile info successfully updated');


        }
        return View::make('user.profile.edit');
    }

    public function editProfilePasswordAction()
    {
        if (Input::server("REQUEST_METHOD") == "POST")
        {
            $rules = array(
                "password" => "required|min:6|confirmed",
                "password_confirmation" => "required|min:6"
            );

            $validation = Validator::make(Input::all(), $rules);
            if ($validation->fails())
                return Redirect::back()->withErrors($validation);

            User::where('id', '=', Auth::user()->id)->update(array(
                'password' => Hash::make(Input::get('password'))
            ));

            return Redirect::route('user/profile')->with('success', 'Password successfully updated');
        }

        return View::make('user.profile.password');
    }

    public function editPasswordAction($user_id)
    {
        # First user, root, should not be editable
        if ($user_id == 1)
            return Redirect::route('404');

        if (Input::server("REQUEST_METHOD") == "POST")
        {
            $rules = array(
                "password" => "required|min:6|confirmed",
                "password_confirmation" => "required|min:6"
            );

            $validation = Validator::make(Input::all(), $rules);
            if ($validation->fails())
                return Redirect::back()->withErrors($validation);

            User::where('id', '=', $user_id)->update(array(
                'password' => Hash::make(Input::get('password'))
            ));

            return Redirect::route('user/index')->with('success', 'Password successfully updated');
        }

        return View::make('user.password')->with('user', User::find($user_id));
    }

    public function indexAction()
    {
        # The first user is root and shouldn't be displayed to anyone
        $users = User::where('id', '<>', '1')->get();
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
        # First user, root, should not be editable
        if ($user_id == 1)
            return Redirect::route('404');

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

        return Redirect::route('user.edit', $user_id)->with('success', 'Roles got updated successfully');
    }

    public function deleteAction($user_id)
    {
        # First user, root, cannot be deleted
        if ($user_id == 1)
            return Redirect::route('404');

        $user = User::find($user_id);
        if (Input::server("REQUEST_METHOD") == "POST")
        {
            $user->delete();
            return Redirect::route('user/index')->with('success', 'User ' . $user->getFullNameWithUsername() . ' got deleted');
        }
        return View::make('user.delete')->with('user', $user);
    }
}
