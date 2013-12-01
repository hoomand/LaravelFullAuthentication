<?php

class Group extends BaseModel {

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

        protected $table = 'group';

        protected $softDelete = true;

        protected $guarded = array(
            "id",
            "created_at",
            "updated_at",
            "deleted_at");

}
