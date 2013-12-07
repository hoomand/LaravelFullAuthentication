<?php

class Permission extends BaseModel {

        protected $table = 'permission';

        protected $softDelete = true;

        protected $guarded = array(
            "id",
            "created_at",
            "updated_at",
            "deleted_at");

        public function roles()
        {
            return $this->belongsToMany('Role', 'role_permission');
        }

        public function __toString()
        {
            return $this->name;
        }

}
