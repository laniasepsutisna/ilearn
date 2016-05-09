<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidModel;

class Quiz extends Model
{
	use UuidModel;

	public $incrementing = false;
	
	protected $fillable = [
		'teacher_id', 'title', 'type', 'time_limit'
	];

	protected $hidden = [
		'created_at', 'updated_at'
	];

	public function getHumanizeTypeAttribute()
	{
		return $this->type === 'multiple_choice' ? 'Pilihan Ganda' : 'Essay';
	}

	public function classrooms()
	{
		return $this->belongsToMany('App\Models\Classroom');
	}

	public function getAttachedToAttribute()
	{
		$ids = [];
		foreach ($this->classrooms as $classroom) {
			$ids[] = $classroom->id;
		}

		return $ids;
	}
}
