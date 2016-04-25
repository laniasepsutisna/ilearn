<?php

namespace App\Models;

use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
	use UuidModel;

	public $incrementing = false;

	protected $fillable = [
		'teacher_id', 'name', 'description', 'picture', 'level'
	];

}
