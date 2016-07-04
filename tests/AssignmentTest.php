<?php

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AssignmentTest extends TestCase
{
  public function testAddAssignment()
  {
  	$user = User::where('username', 'timoti')->first();

    $this->actingAs($user)
      ->visit('/assignments/create')
    	->see('Tugas Baru')
    	->type('Tugas Baru', 'title')
    	->type('Content Tugas Baru', 'content')
    	->press('assignmentSubmit');
  }
}
