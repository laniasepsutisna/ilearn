<?php

namespace App\Models;

use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
	use UuidModel;

	public $incrementing = false;

	protected $fillable = [
		'teacher_id', 'classroom_id', 'action', 'route', 'detail'
	];
	
	public function teacher()
	{
		return $this->belongsTo('App\Models\User');
	}

	public function classroom()
	{
		return $this->belongsTo('App\Models\Classroom')->orderBy('created_at', 'DESC');
	}
}
