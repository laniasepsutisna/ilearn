<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
	protected $fillable = [
		'user_id', 'title', 'content', 'status'
	];

	protected $hidden = [
		'user_id', 'created_at', 'updated_at'
	];

    public function users()
    {
    	return $this->belongsTo(User::class);
    }
}
