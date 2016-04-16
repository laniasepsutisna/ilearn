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
		'user_id', 'title', 'file', 'content'
	];

	public function classrooms()
	{
		return $this->belongsToMany('App\Models\Classroom')->withPivot('deadline');
	}

	public function submissions()
	{
		return $this->belongsToMany('App\Models\User', 'submissions')->withPivot('title', 'file', 'content');
	}

	public function getDeadlineAttribute()
	{
		foreach ($this->classrooms as $classroom) {
			return Carbon::parse($classroom->pivot->deadline);
		}
	}

	public function addAssignments($assignment, $deadline)
	{
		return $this->classrooms()->attach($assignment, ['deadline' => Carbon::parse($deadline)]);
	}
}
