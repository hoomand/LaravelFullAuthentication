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
        $I->see('Success', 'h4');
        $I->see('You are logged in');
    }

    public function checkUserRootCanSeeUsersLink(TestGuy $I) {
        $I->wantTo('make sure user root can see the Users link on the home page');
        # Login as root
        $I->amLoggedAs(User::find(1));

        $I->amOnPage('/');
        $I->see('Users', 'a[href$="user/index"]');
    }

    public function checkUserRootCanCreateNewUser(TestGuy $I) {
        $I->wantTo('make sure user root can create new user');
        # Login as root
        $I->amLoggedAs(User::find(1));

        $I->amOnPage('/user/index');
        $I->click('Create User', '.container a[href$="user/create"]');
        $I->see('Create New User', '.container h3');

        $username = 'testuser';
        $firstname = 'test';
        $lastname = 'test';
        $password = 'testpass';
        $email = 'test@example.com';

        $I->fillField('#username', $username);
        $I->fillField('#first_name', $firstname);
        $I->fillField('#last_name', $lastname);
        $I->fillField('#password', $password);
        $I->fillField('#password_confirmation', $password);
        $I->selectOption('#female','female');
        $I->fillField('#email', $email);
        $I->fillField('#phone', '11223344');
        $I->fillField('#cellphone', '09127752066');
        $I->click('#saveuser');
        $I->seeCurrentUrlEquals('/user/index');
        $I->see('Success', 'h4');
        $I->see("@$username [$firstname $lastname]");
        $I->seeInDatabase('user', array(
            'username' => $username,
            'first_name' => $firstname,
            'last_name' => $lastname,
            'email' => $email,
        ));

    }


}
