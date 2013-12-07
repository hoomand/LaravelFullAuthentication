<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends BaseModel implements UserInterface, RemindableInterface {

        /**
         * Contains all validation rules used in the controller when
         * persisting this object in the database
         *
         * @return array
         */
        public static $create_rules = array(
            'username' => 'required|unique:user|alpha_num|min:4',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'email' => 'required|email',
            'gender' => 'required|in:male,female',
            'first_name' => 'required|alpha_space',
            'last_name' => 'required|alpha_space'
        );

	public static $update_rules = array(
                'email' => 'required|email',
                'gender' => 'required|in:male,female',
                'first_name' => 'required|alpha_space',
                'last_name' => 'required|alpha_space'
        );

        public function roles()
        {
            return $this->belongsToMany('Role', 'user_role');
        }

        public function getFullName()
        {
            return $this->first_name . ' ' . $this->last_name;
        }

        public function getFullNameWithUsername()
        {
            return '@' . $this->username . ' [' . $this->getFullName() . ']';
        }

        public function getRoleNames()
        {
            $roles = array();
            foreach ($this->roles as $role)
                array_push($roles, (string) $role);

            return $roles;
        }

        public function getRolePermissionNames()
        {
            $permissions = array();
            foreach ($this->roles as $role)
                foreach ($role->permissions as $permission)
                    array_push($permissions, (string) $permission);

            return array_unique($permissions);
        }
/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

}
