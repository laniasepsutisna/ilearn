<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
	/**
	 * Fillable field
	 * @var array
	 */
	protected $fillable = ['user_id', 'title', 'content', 'status'];

	/**
	 * Relationship to user table
	 * @return json of user
	 */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
