<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function toggleStatus(Request $request)
	{
		$this->validate($request, [
      'user_id' => 'required|exists:users,id'
    ]);

    $user = User::findOrFail($request->user_id);

    if($user->status === 'active') {
      $user->status = 'banned';
    } else {
      $user->status = 'active';
    }

    $user->save();

    return response()->json([
      'user_status' => $user->status
    ]);
	}
}
