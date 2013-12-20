<?php
$I = new SeleniumGuy($scenario);

$I->am('root');
$I->wantTo('login with user root, see all admin links & edit my profile');
$I->amOnPage('/');
$I->see('Welcome to Rasla');
$I->seeLink('Login', '/login');
$I->click('Login', '.nav');
//$I->see('Login', 'h2');
$I->fillField('#username', 'root');
$I->fillField('#password', 'whatever123');
$I->click('#login');
$I->see('Success', 'h4');
$I->see('You are logged in');

$I->seeLink('root', '/user/profile');
$I->seeLink('Users', '/user/index');
$I->seeLink('Roles', '/role/index');

$I->click('root','.nav');
$I->see('root', '.container h3');
$I->see('First Name', '.table tbody tr th');

$I->seeLink('Logout', '/logout');
$I->click('Logout');
