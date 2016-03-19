<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::paginate(10);
        return $users;
    }

    public function teacher(Request $request)
    {
        $users = Role::where('name', 'teacher')->first()->users()
                ->where(function($query) use ($request){
                    $query->where('identitynumber', 'LIKE', '%' . $request->q . '%')   
                            ->orWhere('firstname', 'LIKE', '%' . $request->q . '%')                        
                            ->orWhere('lastname', 'LIKE', '%' . $request->q . '%');
                })->orderBy('created_at', 'desc')->get();

        return ['total_count' => $users->count(), 'items' => $users];
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return $user;
    }

}
