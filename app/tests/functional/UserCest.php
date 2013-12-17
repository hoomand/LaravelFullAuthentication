<?php
use \TestGuy;

class UserCest
{

    public function _before()
    {
        $user = new User;
        $user->username = "mandali";
        $user->first_name = "Mohammad";
        $user->last_name = "Nad Ali";
        $user->password = Hash::make('ohlala');
        $user->email = "mandali@mandalestan.com";
        $user->phone = "44882233";

        $user->save();
    }

    public function _after()
    {
    }

    // tests
    public function addUserDirectlyThroughModel(TestGuy $I) {
        // We check the user we added in _before() does exist
        $I->seeInDatabase('user', array(
            'username' => 'mandali',
            'first_name' => 'Mohammad',
            'last_name' => 'Nad Ali',
            'email' => 'mandali@mandalestan.com',
            'phone' => '44882233'
        ));
    }

}
