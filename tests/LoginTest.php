<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
  /**
   * A Login test.
   *
   * @return void
   */
  public function testLoginAdmin()
  {
    $this->visit('/')
    	->type('admin', 'username')
    	->type('secret', 'password')
    	->press('loginButton')
    	->seePageIs('/lms-admin');
  }

  /**
   * A Login test.
   *
   * @return void
   */
  public function testLoginTeacher()
  {
    $this->visit('/')
    	->type('timoti', 'username')
    	->type('secret', 'password')
    	->press('loginButton')
    	->seePageIs('/home');
  }

  /**
   * A Login test.
   *
   * @return void
   */
  public function testLoginStudent()
  {
    $this->visit('/')
    	->type('reynold', 'username')
    	->type('secret', 'password')
    	->press('loginButton')
    	->seePageIs('/home');
  }
}
