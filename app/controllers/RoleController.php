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

        $role_permissions = Role::find($role_id)->permissions;
        $role_permission_ids = array();
        foreach ($role_permissions as $rp)
            array_push($role_permission_ids, $rp->id);

        return View::make('role.edit')
            ->with('role', Role::find($role_id))
            ->with('all_permissions', Permission::all())
            ->with('role_permission_ids', $role_permission_ids);
    }

}
