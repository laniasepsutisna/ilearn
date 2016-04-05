<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
    	$announcements = Announcement::orderBy('created_at', 'DESC')->paginate(10);
    	$page_title = 'Pengumuman';

    	return view('user.global.announcements', compact('announcements', 'page_title'));
    }
}
