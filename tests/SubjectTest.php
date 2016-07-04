<?php

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class SubjectTest extends TestCase
{
  public function testExample()
  {
    $user = User::where('username', 'admin')->first();

    $this->actingAs($user)
      ->visit('/lms-admin/subjects')
      ->see('Semua Mata Pelajaran')
      ->assertViewHas('subjects');
  }

  public function testAddSubject()
  {
    $user = User::where('username', 'admin')->first();

    $this->actingAs($user)
      ->visit('/lms-admin/subjects/create')
      ->see('Tambah Mata Pelajaran')
      ->type('Mata Pelajaran Baru', 'name')
      ->type('Deskripsi Mata Pelajaran Baru', 'description')
      ->press('Save');
  }

  public function testEditSubject()
  {
    $user = User::where('username', 'admin')->first();

    $this->actingAs($user)    
      ->visit('/lms-admin/subjects')
      ->click('Edit')
      ->see('Edit Mata Pelajaran')
      ->type('Mata Pelajaran Edit Baru', 'name')
      ->type('Deskripsi Mata Pelajaran Edit Baru', 'description')
      ->press('Update');
  }

  public function testRemoveSubject()
  {
    $user = User::where('username', 'admin')->first();

    $this->actingAs($user)
      ->visit('/lms-admin/subjects')
      ->see('Semua Mata Pelajaran')
      ->press('Hapus')
      ->seePageIs('lms-admin/subjects');
  }
}
