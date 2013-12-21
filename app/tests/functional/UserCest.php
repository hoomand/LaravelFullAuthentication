<?php
use \TestGuy;

class UserCest
{
    public $username = 'testuser';
    public $firstname = 'test';
    public $lastname = 'test';
    public $password = 'testpass';
    public $email = 'test@example.com';

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

    public function checkUserRootCanManageUsers(TestGuy $I) {

        $I->wantTo('make sure user root can create new user');
        $I->amLoggedAs(User::find(1));
        $I->amOnPage('/user/index');
        $I->click('Create User', '.container a[href$="user/create"]');
        $I->see('Create New User', '.container h3');
        $I->fillField('#username', $this->username);
        $I->fillField('#first_name', $this->firstname);
        $I->fillField('#last_name', $this->lastname);
        $I->fillField('#password', $this->password);
        $I->fillField('#password_confirmation', $this->password);
        $I->selectOption('#female','female');
        $I->fillField('#email', $this->email);
        $I->fillField('#phone', '11223344');
        $I->fillField('#cellphone', '09127752066');
        $I->click('#saveuser');
        $I->seeCurrentUrlEquals('/user/index');
        $I->see('Success', 'h4');
        $I->see("@$this->username [$this->firstname $this->lastname]");
        $I->seeInDatabase('user', array(
            'username' => $this->username,
            'first_name' => $this->firstname,
            'last_name' => $this->lastname,
            'email' => $this->email,
        ));


        $I->wantTo('make sure user root can edit the newly created user in the previous step');
        $I->amLoggedAs(User::find(1));
        $I->amOnPage('/user/index');
        $I->see($this->username);
        $I->click('#edit_button_' . $this->username);
        $I->seeCurrentUrlMatches('~/user/edit/(\d+)$~');
        $I->see('Editing', 'h3');
        $I->see($this->username, '.text-info');
        $I->fillField("#first_name", $this->firstname . 'edited');
        $I->fillField('#last_name', $this->lastname . 'edited');
        $I->selectOption('#male','male');
        $I->fillField('#email', 'blah@blah.com');
        $I->fillField('#phone', '666666');
        $I->fillField('#cellphone', '09357752066');
        $I->click('#edit_user_form input[type=submit]');
        $I->see('Success', 'h4');
        $I->see('User info successfully updated');
        $I->seeCurrentUrlEquals('/user/index');
        $I->seeInDatabase('user', array(
            'username' => $this->username,
            'first_name' => $this->firstname . 'edited',
            'last_name' => $this->lastname . 'edited',
            'email' => 'blah@blah.com',
        ));


        $I->wantTo('check if root can delete the created user in the previous step');
        $I->amLoggedAs(User::find(1));
        $I->amOnPage('/user/index');
        $I->see($this->username);
        $I->click('#delete_button_' . $this->username);
        $I->seeCurrentUrlMatches('~/user/delete/(\d+)$~');
        $I->see('Deleting User');
        $I->seeLink('No', '/user/index');
        $I->click('#delete_user_form input[type=submit]');
        $I->seeCurrentUrlEquals('/user/index');
        $I->dontSeeInDatabase('user', array(
            'username' => $this->username
        ));

    }

    public function logout(TestGuy $I) {
        $I->am('root');
        $I->amLoggedAs(User::find(1));
        $I->wantTo('logout');
        $I->amOnPage('/');
        $I->seeLink('Logout', '/logout');
        $I->click('Logout');
    }



}
