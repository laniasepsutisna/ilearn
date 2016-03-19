<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
	protected  $fillable = [
		'user_id', 'picture', 'cover', 'dateofbirth', 'address', 'telp_no', 'parent_telp_no'
	];

	protected $hidden = [
		'id', 'user_id', 'created_at', 'updated_at'
	];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
