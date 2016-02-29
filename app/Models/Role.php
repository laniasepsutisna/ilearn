<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	/**
	 * Relationship to User
	 * @return json of user data
	 */
    public function users()
    {
    	return $this->belongsToMany(User::class);
    }
}
