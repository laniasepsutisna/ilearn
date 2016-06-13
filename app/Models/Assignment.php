<?php

namespace App\Models;

use App\Traits\UuidModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Assignment extends Model
{
	use UuidModel;

	public $incrementing = false;

	protected $fillable = [
		'teacher_id', 'title', 'file', 'content'
	];

	protected $hidden = [
		'user_id', 'created_at', 'updated_at'
	];

	public function classrooms()
	{
		return $this->belongsToMany('App\Models\Classroom')->withPivot('deadline')->withTimestamps();
	}

	public function submissions()
	{
		return $this->belongsToMany('App\Models\User', 'submissions')->withPivot('title', 'file', 'content')->withTimestamps();;
	}

	public function getAttachedToAttribute()
	{
		$ids = $this->classrooms->map(function($class){
			return $class->id;
		})->toArray();

		return $ids;
	}

	public function getAttachedClassroomAttribute()
	{
		$attached = [];
		foreach($this->classrooms as $class) {
			$attached[$class->id] = [
				'classname' => $class->classname,
				'deadline' => $class->pivot->deadline
			];
		}

		return $attached;
	}

	public function addAssignments($assignment, $deadline)
	{
		return $this->classrooms()->attach($assignment, ['deadline' => Carbon::parse($deadline)]);
	}
}
