<?php
$I = new WebGuy($scenario);
$I->wantTo('do a simple login');
$I->amOnPage('/login');
$I->see('Login');
