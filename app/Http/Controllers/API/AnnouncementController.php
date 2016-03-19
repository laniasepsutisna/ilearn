<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
    	$announcements = Announcement::paginate(5);
    	return $announcements;
    }

    public function show($id)
    {
    	$announcement = Announcement::findOrFail($id);
    	return $announcement;
    }

}
