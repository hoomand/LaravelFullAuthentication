<?php

class Role extends BaseModel {

        /**
         * Contains all validation rules used in the controller when
         * persisting this object in the database
         *
         * @return array
         */
        public static $create_rules = array(
            'name' => 'required|unique:role|alpha_num|min:4'
        );

        public static $update_rules = array(
            'name' => 'required|unique:role|alpha_num|min:4'
        );

        public function permissions()
        {
            return $this->belongsToMany('Permission', 'role_permission');
        }

        public function users()
        {
            return $this->belongsToMany('User', 'user_role');
        }

        public function delete()
        {
            $this->users()->detach();
            $this->permissions()->detach();
            parent::delete();
        }


        protected $table = 'role';

        protected $guarded = array(
            "id",
            "created_at",
            "updated_at",
            "deleted_at");

        public function __toString()
        {
            return $this->name;
        }

}
