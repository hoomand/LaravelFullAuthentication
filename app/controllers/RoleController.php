<?php

class RoleController extends BaseController {

    public function indexAction()
    {
        return View::make('role.index')->with('roles', Role::all());
    }

    public function editAction($role_id)
    {
        if (Input::server("REQUEST_METHOD") == "POST")
        {
            $validation = Role::validate_update(Input::all());
            if ($validation->fails())
                return Redirect::back()->withErrors($validation)->withInput();

            Role::where('id', '=', $role_id)->update(array(
                'name' => Input::get('name'),
                'description' => Input::get('description')
            ));

            return Redirect::route('role/index')->with('success', 'Role ' . Role::find($role_id)->name . ' got updated successfully');
        }
        return View::make('role.edit')
            ->with('role', Role::find($role_id))
            ->with('permissions', Permission::all());
    }

}
