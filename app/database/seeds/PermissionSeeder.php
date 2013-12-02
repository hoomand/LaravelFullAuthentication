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
                    'name' => 'users_delete',
                    'display' => 'delete users'
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
                    'name' => 'password_edit',
                    'display' => 'edit password'
                ))
            );

        foreach ($groups as $group)
            foreach ($group as $action)
                Permission::create($action);
    }
}
