<?php
class GroupSeeder extends DatabaseSeeder {
    public function run() {
        $groups = array( 
            array(
                "name" => "admins"
            ),
            array(
                "name" => "editors"
            )
        );

        foreach ($groups as $group)
        {
            Group::create($group);
        }
    }
}
