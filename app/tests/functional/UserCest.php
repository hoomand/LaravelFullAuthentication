<?php
/**
 * @group root
 */
use \TestGuy;
use \Codeception\Util\Stub as Stub;

class UserCest
{
    private static $users;
    private $persisted_user;

    static function init_static()
    {
        self::$users = array(
            'ghelgheli' => Stub::make('User', array(
                'username' => 'ghelgheli',
                'first_name' => 'ghelgheli',
                'last_name' => 'ghelghelizade',
                'password' => Hash::make('ghelgheli'),
                'email' => 'ghelghel@ghelghelian.com',
                'phone' => '445566',
                'cellphone' => '09125126044'
            )),
        );

    }

    public function _before()
    {

        /*
         * felfeli would be persisted in the database here
         * Note: A property defined in _before is not accessible
         * in other methods. A property defined in other methods
         * is accessible in _before(), but doesn't feel right! I
         * instantiated persisted_user in another method and got
         * no error when I tried to save it in here, but I didn't
         * see it in the database, even though a test to see it
         * in the db worked, but somehow it didn't feel right.
         */
        $this->persisted_user = new User;
        $this->persisted_user->username = 'felfeli';
        $this->persisted_user->password = Hash::make('felfeli');
        $this->persisted_user->first_name = 'felfel';
        $this->persisted_user->last_name = 'felfelizade';
        $this->persisted_user->email = 'felfel@felfeligan.com';

        $this->persisted_user->save();
    }

    public function _after()
    {
        $this->persisted_user->delete();
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

    public function rootCanEditProfile(TestGuy $I) {
        $I->am('root');
        $I->wantTo('see if root can edit his profile');
        $I->amLoggedAs(User::find(1));
        $I->click('root');
        $I->see('root', '.container h3');
        $I->see('First Name');
        $I->see('Last Name');
        $I->see('Gender');
        $I->see('Email');
        $I->see('Phone');
        $I->see('Cell Phone');
        $I->seeLink('Change Password');
        $I->seeLink('Edit Profile');
        $I->click('Edit Profile');
        $I->seeCurrentUrlEquals('/user/profile/edit');

        $I->fillField('#first_name', self::$users['ghelgheli']->first_name);
        $I->fillField('#last_name', self::$users['ghelgheli']->last_name);
        $I->fillField('#email', self::$users['ghelgheli']->email);
        $I->fillField('#phone', self::$users['ghelgheli']->phone);
        $I->fillField('#cellphone', self::$users['ghelgheli']->cellphone);
        $I->selectOption('#female', 'female');
        $I->click("Update");

        $I->seeCurrentUrlEquals('/user/profile');
        $I->see('Success', 'h4');
        $I->see('Profile info successfully updated');
    }

    public function checkUserRootCanAddUser(TestGuy $I) {

        $I->wantTo('make sure user root can create new user');
        $I->amLoggedAs(User::find(1));
        $I->amOnPage('/user/index');
        $I->click('Create User', '.container a[href$="user/create"]');
        $I->see('Create New User', '.container h3');
        $I->fillField('#username', self::$users['ghelgheli']->username);
        $I->fillField('#first_name', self::$users['ghelgheli']->first_name);
        $I->fillField('#last_name', self::$users['ghelgheli']->last_name);
        $I->fillField('#password', self::$users['ghelgheli']->password);
        $I->fillField('#password_confirmation', self::$users['ghelgheli']->password);
        $I->selectOption('#female','female');
        $I->fillField('#email', self::$users['ghelgheli']->email);
        $I->fillField('#phone', self::$users['ghelgheli']->phone);
        $I->fillField('#cellphone', self::$users['ghelgheli']->cellphone);
        $I->click('#saveuser');
        $I->seeCurrentUrlEquals('/user/index');
        $I->see('Success', 'h4');
        $I->see("@" . self::$users['ghelgheli']->username . " [" . self::$users['ghelgheli']->first_name . " " . self::$users['ghelgheli']->last_name . "]");
        $I->seeInDatabase('user', array(
            'username' => self::$users['ghelgheli']->username,
            'first_name' => self::$users['ghelgheli']->first_name,
            'last_name' => self::$users['ghelgheli']->last_name,
            'email' => self::$users['ghelgheli']->email,
        ));
    }

    public function checkUserRootCanEditUser(TestGuy $I) {
        $I->wantTo('make sure user root can edit the newly created user in the previous step');
        $I->amLoggedAs(User::find(1));
        $I->haveInDatabase('user', array(
            'username' => self::$users['ghelgheli']->username,
            'first_name' => self::$users['ghelgheli']->firstname,
            'last_name' => self::$users['ghelgheli']->lastname,
            'email' => self::$users['ghelgheli']->email,
            'password' => Hash::make(self::$users['ghelgheli']->password),
            'phone' => self::$users['ghelgheli']->phone,
            'cellphone' => self::$users['ghelgheli']->cellphone,
            'email' => self::$users['ghelgheli']->email
        ));


        $I->amOnPage('/user/index');
        $I->see(self::$users['ghelgheli']->username);
        $I->click('#edit_button_' . self::$users['ghelgheli']->username);
        $I->seeCurrentUrlMatches('~/user/edit/(\d+)$~');
        $I->see('Editing', 'h3');
        $I->see(self::$users['ghelgheli']->username, '.text-info');
        $I->fillField("#first_name", self::$users['ghelgheli']->firstname . 'edited');
        $I->fillField('#last_name', self::$users['ghelgheli']->lastname . 'edited');
        $I->selectOption('#male','male');
        $I->fillField('#email', 'blah@blah.com');
        $I->fillField('#phone', '666666');
        $I->fillField('#cellphone', '09357752066');
        $I->click('#edit_user_form input[type=submit]');
        $I->see('Success', 'h4');
        $I->see('User info successfully updated');
        $I->seeCurrentUrlEquals('/user/index');
        $I->seeInDatabase('user', array(
            'username' => self::$users['ghelgheli']->username,
            'first_name' => self::$users['ghelgheli']->firstname . 'edited',
            'last_name' => self::$users['ghelgheli']->lastname . 'edited',
            'email' => 'blah@blah.com',
        ));
    }

/*
 *        $I->wantTo('see if user root can assign role to the new user');
 *        $I->amOnPage('/user/index');
 *        $I->click('#edit_button_' . $this->username);
 *        $I->seeCurrentUrlMatches('~/user/edit/(\d+)$~');
 *        $I->see('Editing', 'h3');
 *        $I->see('Roles', 'h4');
 *        $I->selectOption('/html/body/div[2]/form[2]/table/tbody/tr/td/input', 'Admin');
 *
 */

    public function checkUserRootCanDeleteUser(TestGuy $I) {
        $I->wantTo('check if root can delete the created user in the previous step');
        $I->amLoggedAs(User::find(1));
        $I->haveInDatabase('user', array(
            'username' => self::$users['ghelgheli']->username,
            'first_name' => self::$users['ghelgheli']->firstname,
            'last_name' => self::$users['ghelgheli']->lastname,
            'email' => self::$users['ghelgheli']->email,
            'password' => Hash::make(self::$users['ghelgheli']->password),
            'phone' => self::$users['ghelgheli']->phone,
            'cellphone' => self::$users['ghelgheli']->cellphone,
            'email' => self::$users['ghelgheli']->email
        ));
        $I->amOnPage('/user/index');
        $I->see(self::$users['ghelgheli']->username);
        $I->click('#delete_button_' . self::$users['ghelgheli']->username);
        $I->seeCurrentUrlMatches('~/user/delete/(\d+)$~');
        $I->see('Deleting User');
        $I->seeLink('No', '/user/index');
        $I->click('#delete_user_form input[type=submit]');
        $I->seeCurrentUrlEquals('/user/index');
        $I->dontSeeInDatabase('user', array(
            'username' => self::$users['ghelgheli']->username
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
