<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidModel;

class Quiz extends Model
{
	use UuidModel;

	public $incrementing = false;
	
	protected $fillable = [
		'teacher_id', 'title', 'time_limit'
	];

	protected $hidden = [
		'created_at', 'updated_at'
	];

	public function classrooms()
	{
		return $this->belongsToMany('App\Models\Classroom');
	}

	public function multiplechoices()
	{
		return $this->hasMany('App\Models\MultipleChoice')->orderBy('created_at', 'DESC');
	}

	public function getAttachedToAttribute()
	{
		$ids = $this->classrooms->map(function($class){
			return $class->id;
		})->toArray();

		return $ids;
	}
}
