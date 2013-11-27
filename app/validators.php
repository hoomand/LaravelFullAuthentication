<?php
Validator::extend('alpha_space', function($attr, $value) {
    return preg_match('/^([a-z\x20])+$/i', $value);
});
