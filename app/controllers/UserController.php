<?php

class UserController extends BaseController {

    public function loginAction() {
        return View::make('user/login');
    }
}
