<?php
$I = new SeleniumGuy($scenario);

$I->am('root');
$I->wantTo('login with user root, see all admin links & edit my profile');
$I->amOnPage('/');
$I->see('Welcome to Rasla');
$I->seeLink('Login', '/login');
$I->click('Login', '.nav');
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
$I->see('Last Name', '.table tbody tr th');
$I->see('Gender', '.table tbody tr th');
$I->see('Email', '.table tbody tr th');
$I->see('Phone', '.table tbody tr th');
$I->see('Cell Phone', '.table tbody tr th');
$I->seeLink('Change Password');
$I->seeLink('Edit Profile');

$I->click('Edit Profile');
$appendee = 'tada';
$first_name = $I->grabValueFrom('#first_name');
$last_name = $I->grabValueFrom('#last_name');
$email = $I->grabValueFrom('#email');
$phone = $I->grabValueFrom('#phone');
$cellphone = $I->grabValueFrom('#cellphone');
$I->fillField('#first_name', $first_name . $appendee);
$I->fillField('#last_name', $last_name . $appendee);
$I->fillField('#email', $appendee . $email);
$I->fillField('#phone', $phone . '77');
$I->fillField('#cellphone', $cellphone . '77');
$I->click('Update');
$I->seeCurrentUrlEquals('/user/profile');
$I->see('Success', 'h4');
$I->see('Profile info successfully updated');

$I->seeLink('Logout', '/logout');
$I->click('Logout');
