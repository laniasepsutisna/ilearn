<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class HomeController extends Controller
{
  public function index()
  {
    return view('user.global.feeds');
  }

  public function profile()
  {
    $user = Auth::user();
    $page_title = 'Profil';

    return view('user.global.profile', compact('user', 'page_title'));
  }

  public function password()
  {
    $user = Auth::user();
    $page_title = 'Password';

    return view('user.global.password', compact('user', 'page_title'));
  }
}
