<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidModel;

class Quiz extends Model
{
	use UuidModel;

	public $incrementing = false;
	
	protected $fillable = [
		'teacher_id', 'title', 'pass_score', 'time_limit'
	];

	protected $hidden = [
		'created_at', 'updated_at'
	];

	public function classrooms()
	{
		return $this->belongsToMany('App\Models\Classroom')->withTimestamps();
	}

	public function students()
	{
		return $this->belongsToMany('App\Models\User', 'quiz_user', 'quiz_id', 'student_id')
			->withPivot('time', 'answer', 'status', 'unanswered', 'correct', 'wrong', 'score');
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
