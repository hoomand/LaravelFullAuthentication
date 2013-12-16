<?php

class BaseModel extends Eloquent
{
        public static function validate_create($data)
        {
            return Validator::make($data, static::$create_rules);
        }
        public static function validate_update($data)
        {
            return Validator::make($data, static::$update_rules);
        }
}
