<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(){
		return view('home');
    }

    public function profile()
    {
        $user = User::where('id', '=', Auth::user()->id)->get();
        $page_title = $user->fullname;
        return view('auth.profile', compact('user', 'page_title'));
    }

}
