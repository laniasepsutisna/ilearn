<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use SoftDeletes;
    
	protected $fillable = ['user_id', 'title', 'content', 'status'];

    public function users()
    {
    	return $this->belongsTo(User::class);
    }
}
