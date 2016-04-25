<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use App\Traits\ClassroomAccessor;

class Classroom extends Model
{
	use ClassroomAccessor;
	
	protected $appends = ['classname', 'teachername'];

	protected $fillable = [
		'id', 'subject_id', 'major_id', 'teacher_id', 'grade', 'description', 'logo', 'cover'
	];

	protected $hidden = [
		'id', 'subject_id', 'major_id', 'created_at', 'discussions', 'updated_at', 'pivot'
	];

	public $incrementing = false;
	
	public static function boot()
	{
        static::creating(function($model){
            $id = $model->getKeyName();
            if(empty($model->$id)){
                $model->$id = substr(Uuid::uuid4()->toString(), 0, 8);
            }
        });

        static::saving(function($model) {
            $id = $model->getKeyName();
        	$original_id = $model->getOriginal($id);

        	if ($original_id !== $model->$id) {
            	$model->$id = $original_id;
        	}
    	});
	}

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
