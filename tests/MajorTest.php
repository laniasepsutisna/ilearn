<?php

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class MajorTest extends TestCase
{
  public function testViewMajor()
  {
    $user = User::where('username', 'admin')->first();

    $this->actingAs($user)
      ->visit('/lms-admin/majors')
      ->see('Semua Jurusan')
      ->assertViewHas('majors');
  }

  public function testAddMajor()
  {
    $user = User::where('username', 'admin')->first();

    $this->actingAs($user)
      ->visit('/lms-admin/majors/create')
      ->see('Tambah Jurusan')
      ->type('Jurusan', 'name')
      ->type('Deskripsi Jurusan Baru', 'description')
      ->press('Save');
  }

  public function testEditMajor()
  {
    $user = User::where('username', 'admin')->first();

    $this->actingAs($user)    
      ->visit('/lms-admin/majors')
      ->click('Edit')
      ->see('Edit Jurusan')
      ->type('Jurusan Edit Baru', 'name')
      ->type('Deskripsi Jurusan Edit Baru', 'description')
      ->press('Update');
  }

  public function testRemoveSubject()
  {
    $user = User::where('username', 'admin')->first();

    $this->actingAs($user)
      ->visit('/lms-admin/majors')
      ->see('Semua Jurusan')
      ->press('Hapus')
      ->seePageIs('lms-admin/majors');
  }
}
