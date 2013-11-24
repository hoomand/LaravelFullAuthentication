<?php
class UserSeeder extends DatabaseSeeder {
    public function run() {
        $users = [
            [
                "username" => "sirbijan",
                "password" => Hash::make('whatever123'),
                "email" => "hoomand@gmail.com"
            ]
        ];

        foreach ($users as $user)
        {
            User::create($user);
        }
    }
}
