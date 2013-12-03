<?php

class Role extends BaseModel {

        /**
         * Contains all validation rules used in the controller when
         * persisting this object in the database
         *
         * @return array
         */
        public static $create_rules = array(
        );

        public static $update_rules = array(
        );

        protected $table = 'role';

        protected $softDelete = true;

        protected $guarded = array(
            "id",
            "created_at",
            "updated_at",
            "deleted_at");

}
