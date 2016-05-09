<?php

namespace App\Traits;

trait ClassroomAccessor 
{
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

	public function getCountCoursesAttribute()
	{
		return $this->courses->count();
	}

	public function getCountQuizAttribute()
	{
		return $this->quizzes->count();
	}

	public function getPaginateQuizzesAttribute()
	{
		return $this->quizzes()->paginate(7);
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
}