<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
  public function testLoginAdmin()
  {
    $this->visit('/')
    	->type('admin', 'username')
    	->type('secret', 'password')
    	->press('loginButton')
    	->seePageIs('/lms-admin');
  }

  public function testErrorLogin()
  {
    $this->visit('/')
      ->type('random', 'username')
      ->type('random', 'password')
      ->press('loginButton')
      ->seePageIs('/')
      ->see('Username dan password tidak cocok atau akun sedang di banned.');
  }

  public function testLoginTeacher()
  {
    $this->visit('/')
    	->type('timoti', 'username')
    	->type('secret', 'password')
    	->press('loginButton')
    	->seePageIs('/home');
  }

  public function testLoginStudent()
  {
    $this->visit('/')
    	->type('reynold', 'username')
    	->type('secret', 'password')
    	->press('loginButton')
    	->seePageIs('/home');
  }
}
