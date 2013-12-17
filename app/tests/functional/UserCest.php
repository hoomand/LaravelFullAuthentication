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

    public function seeLoginPage(TestGuy $I) {

        $I->wantTo('see the login page');
        $I->amOnPage('/login');
        $I->see('Login','h2');
    }

    public function successfulLoginAsRoot(TestGuy $I) {
        $I->wantTo('successfully login as root');
        $I->fillField('#username', 'root');
        $I->fillField('#password', 'whatever123');
        $I->click('#login');
        $I->seeCurrentUrlEquals('/');

    }


}