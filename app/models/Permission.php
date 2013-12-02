<?php

class Permission extends BaseModel {

        protected $table = 'permission';

        protected $softDelete = true;

        protected $guarded = array(
            "id",
            "created_at",
            "updated_at",
            "deleted_at");

}
