<?php

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AnnouncementTest extends TestCase
{
  /**
   * A announcement test example.
   *
   * @return void
   */
  public function testAnnouncement()
  {
  	$user = User::where('username', 'admin')->first();

    $this->actingAs($user)
    	->visit('/lms-admin/announcements')
    	->see('Tabel Pengumuman');
  }

  /**
   * A insert announcement test example.
   *
   * @return void
   */
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
}
