<?php

class BaseModel extends Eloquent
{
        public static function validate($data)
        {
            return Validator::make($data, static::$rules);
        }
        public static function validate_update($data)
        {
            return Validator::make($data, static::$update_rules);
        }
}
