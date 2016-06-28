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

	public function classrooms()
	{
		return $this->belongsToMany('App\Models\Classroom')->withTimestamps();
	}

	public function modules()
	{
		return $this->hasMany('App\Models\Module')->orderBy('created_at', 'ASC');
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
				'classname' => $class->classname
			];
		}
		return $attached;
	}

    public function getPictureSmAttribute()
    {
        return url('/uploads/courses/300x300-' . $this->picture);
    }
}
