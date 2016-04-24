<?php

namespace App\Models;

use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Classroom extends Model
{
	use UuidModel;

	protected $appends = ['classname', 'teachername'];

	protected $fillable = [
		'id', 'subject_id', 'major_id', 'teacher_id', 'grade', 'description', 'logo', 'cover'
	];

	protected $hidden = [
		'id', 'subject_id', 'major_id', 'created_at', 'discussions', 'updated_at', 'pivot'
	];

	public $incrementing = false;

	public function teacher()
	{
		return $this->belongsTo('App\Models\User');
	}

	public function students()
	{
		return $this->belongsToMany('App\Models\User');
	}

	public function subject()
	{
		return $this->belongsTo('App\Models\Subject');
	}

	public function major()
	{
		return $this->belongsTo('App\Models\Major');
	}

	public function discussions()
	{
		return $this->hasMany('App\Models\Discussion')->orderBy('created_at', 'DESC');
	}

	public function assignments()
	{
		return $this->belongsToMany('App\Models\Assignment')->withPivot('deadline')->withTimestamps()->orderBy('assignment_classroom.created_at', 'DESC');
	}

	public function getPaginateDiscussionsAttribute()
	{
		return $this->discussions()->where('parent_id', '')->paginate(7);
	}

	public function getCountAvailableAssignmentsAttribute()
	{
		return $this->assignments()->where('deadline', '>', date('Y-m-d'))->count();
	}

	public function getPaginateAvailableAssignmentsAttribute()
	{
		return $this->assignments()->where('deadline', '>', date('Y-m-d'))->paginate(7, ['*'], 'class_assignment');
	}

	public function getShowFiveAssignmentsAttribute()
	{
		return $this->assignments()->where('deadline', '>', date('Y-m-d'))->limit(5)->get();
	}

	public function getTeacherNameAttribute()
	{
		return $this->teacher->firstname . ' ' . $this->teacher->lastname;
	}

	public function getSubjectNameAttribute()
	{
		return $this->subject->name;
	}

	public function getMajorNameAttribute()
	{
		return $this->major->name;
	}

	public function getClassNameAttribute()
	{
		return $this->grade . ' ' . $this->major->name . ' ' . $this->subject->name;
	}

	public function getAssignmentTitleAttribute()
	{
		return $this->assignments;
	}

	public function addMembers($users)
	{
		if( is_array($users) ) {
			foreach ($users as $user) {
				return $this->users()->attach($user);
			}
		}

		return $this->users()->attach($users);
	}

	public function isMember($user)
	{
		foreach ($this->students as $student) {
			if($student->id === $user) {
				return true;
			}
		}
		return false;
	}
}
