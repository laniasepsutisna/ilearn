<?php

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AnnouncementTest extends TestCase
{
  public function testAnnouncement()
  {
  	$user = User::where('username', 'admin')->first();

    $this->actingAs($user)
    	->visit('/lms-admin/announcements')
    	->see('Pengumuman');
  }

  public function testInsertAnnouncement()
  {
    $user = User::where('username', 'admin')->first();

    $this->actingAs($user)
    	->visit('/lms-admin/announcements/create')
    	->see('Tambah Pengumuman')
    	->type('New Announcements', 'title')
    	->select('danger', 'status')
    	->type('Announcement Content', 'content')
    	->press('Save');
  }

  public function testEditAnnouncement()
  {
    $user = User::where('username', 'admin')->first();

    $this->actingAs($user)    
      ->visit('/lms-admin/announcements')
      ->click('Edit')
      ->see('Edit Pengumuman')
      ->type('Pengumuman Edit Baru', 'title')
      ->select('danger', 'status')
      ->type('Deskripsi Pengumuman Edit Baru', 'content')
      ->press('Update');
  }

  public function testRemoveAnnouncement()
  {
    $user = User::where('username', 'admin')->first();

    $this->actingAs($user)
      ->visit('/lms-admin/announcements')
      ->see('Pengumuman')
      ->press('Hapus')
      ->seePageIs('lms-admin/announcements');
  }
}
