<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct(){
    	$this->middleware('auth', ['only' => 'index']);
    }

    public function index(){
    	$users = Auth::user();
		return view('home', compact('users'));
    }
}
