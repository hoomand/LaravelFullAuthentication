<?php
class UserSeeder extends DatabaseSeeder {
    public function run() {
        $users = array( 
            array(
                "username" => "root",
                "password" => Hash::make('whatever123'),
                "email" => "admin@test.com",
                "first_name" => "Admin",
                "last_name" => "Admin",
                "cellphone" => "",
                "gender" => "male"
            ),
            array(
                "username" => "reza",
                "password" => Hash::make('rezareza'),
                "email" => "datairan@gmail.com",
                "first_name" => "Reza",
                "last_name" => "Faghihi",
                "cellphone" => "+989125208474",
                "gender" => "male"
            ),
            array(
                "username" => "ramin",
                "password" => Hash::make('raminramin'),
                "email" => "ram.rezazadeh@gmail.com",
                "first_name" => "Ramin",
                "last_name" => "Rezazadeh",
                "cellphone" => "+98",
                "gender" => "male"
            ),
            array(
                "username" => "iman",
                "password" => Hash::make('imaniman'),
                "email" => "e_nassirian@yahoo.com",
                "first_name" => "Iman",
                "last_name" => "Nasirian",
                "cellphone" => "+98",
                "gender" => "female"
            )
        );

        foreach ($users as $user)
        {
            User::create($user);
        }
    }
}
