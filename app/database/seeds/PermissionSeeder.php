<?php
class PermissionSeeder extends DatabaseSeeder {
    public function run() {
        $groups = array(
            "users_management" => array(
                array(
                    'name' => 'users_view',
                    'display' => 'view users'
                ),
                array(
                    'name' => 'users_edit',
                    'display' => 'edit users'
                ),
                array(
                    'name' => 'users_edit_password',
                    'display' => 'edit users password'
                ),
                array(
                    'name' => 'users_create',
                    'display' => 'create users'
                ),
                array(
                    'name' => 'users_delete',
                    'display' => 'delete users'
                )),
            'roles_management' => array(
                array(
                    'name' => 'roles_view',
                    'display' => 'view roles'
                ),
                array(
                    'name' => 'roles_edit',
                    'display' => 'edit roles'
                ),
                array(
                    'name' => 'roles_delete',
                    'display' => 'delete roles'
                ),
                array(
                    'name' => 'roles_create',
                    'display' => 'create roles'
                )),
            'user' => array(
                array(
                    'name' => 'profile_view',
                    'display' => 'view profile'
                ),
                array(
                    'name' => 'profile_edit',
                    'display' => 'edit profile'
                ),
                array(
                    'name' => 'profile_edit_password',
                    'display' => "edit profile password"
                ))
            );

        foreach ($groups as $group)
            foreach ($group as $action)
                Permission::create($action);
    }
}
