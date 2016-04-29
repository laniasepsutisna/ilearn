<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidModel;

class Module extends Model
{
	use UuidModel;

	public $incrementing = false;
	
	protected $fillable = [
		'course_id', 'name', 'description', 'media', 'file'
	];

	protected $hidden = [
		'created_at', 'updated_at'
	];
}
