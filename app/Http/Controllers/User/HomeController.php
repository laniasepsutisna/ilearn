<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('user.students.home.feeds');
    }

    public function profile()
    {
        $user = User::find(Auth::user()->id);
        $page_title = 'Profil';

        return view('user.global.profile', compact('user', 'page_title'));
    }

    public function update()
    {
        //
    }

    public function passwordupdate()
    {
        //
    }
}
