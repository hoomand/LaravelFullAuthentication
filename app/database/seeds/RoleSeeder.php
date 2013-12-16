<?php
class RoleSeeder extends DatabaseSeeder {
    public function run() {
        $roles = array(
            array(
                "name" => "admins"
            ),
            array(
                "name" => "moderators"
            )
        );

        foreach ($roles as $role)
        {
            Role::create($role);
        }
    }
}
