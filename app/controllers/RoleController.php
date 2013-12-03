<?php

class RoleController extends BaseController {

    public function indexAction()
    {
        return View::make('role.index')->with('roles', Role::all());
    }

}
