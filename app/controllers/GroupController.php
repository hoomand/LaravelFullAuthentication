<?php

class GroupController extends BaseController {

    public function indexAction()
    {
        return View::make('group.index')->with('groups', Group::all());
    }

}
