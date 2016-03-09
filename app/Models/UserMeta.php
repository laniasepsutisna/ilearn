<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
	protected  $fillable = [
		'user_id', 'picture', 'cover','dateofbirth', 'address', 'telp_no', 'parent_telp_no', 'social_url'
	];

    public function users()
    {
    	return $this->belongsTo(User::class);
    }
}
