<?php

namespace App\Models;

use App\Traits\UuidModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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

	public function getDeadlineAttribute()
	{
		foreach ($this->classrooms as $classroom) {
			
			return Carbon::parse($classroom->pivot->deadline);
		}
	}

	public function getIsDeadlineAttribute()
	{
		$due = $this->deadline->timezone('Asia/Makassar');
		$now = Carbon::now('Asia/Makassar');
		$deadline = $now->gte($due);

		return $deadline;
	}

	public function getAttachedToAttribute()
	{
		$ids = [];
		foreach ($this->classrooms as $classroom) {
			$ids[] = $classroom->id;
		}

		return $ids;
	}

	public function getAttachedClassroomAttribute()
	{
		$attached = [];
		foreach($this->classrooms as $class) {
			$attached[$class->id] = [
				'classname' => $class->classname,
				'deadline' => Carbon::parse($class->pivot->deadline)->toFormattedDateString()
			];
		}
		return $attached;
	}

	public function addAssignments($assignment, $deadline)
	{
		return $this->classrooms()->attach($assignment, ['deadline' => Carbon::parse($deadline)]);
	}
}
