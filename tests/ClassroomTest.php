<?php

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ClassroomTest extends TestCase
{
	protected $classroom; // You need to create the classroom first on admin.

  public function __construct()
  {
  	$this->classroom = 'XII UPW IPA';
  }

  public function testStudentSeeClass()
  {
    $user = User::where('username', 'reynold')->first();

    $this->actingAs($user)
    	->visit('/home')
      ->click($this->classroom) 
      ->see($this->classroom);
  }

  public function testTeacherSeeClass()
  {
    $user = User::where('username', 'timoti')->first();

    $this->actingAs($user)
    	->visit('/home')
      ->click($this->classroom)
      ->see($this->classroom);
  }

  public function testAddDiscussion()
  {
    $user = User::where('username', 'reynold')->first();

    $this->actingAs($user)
    	->visit('/home')
      ->click($this->classroom)
      ->see($this->classroom)
      ->type('Diskusi', 'content')
      ->press('submitDiscussion');
  }

  public function testRemoveDiscussion()
  {
    $user = User::where('username', 'reynold')->first();

    $this->actingAs($user)
    	->visit('/home')
      ->click($this->classroom)
      ->see($this->classroom)
      ->see($user->fullname)
      ->press('Hapus');
  }
}
