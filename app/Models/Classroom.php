<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidModel;

class Classroom extends Model
{
    use UuidModel;

    protected $appends = ['classname'];

	protected $fillable = [
        'id', 'subject_id', 'major_id', 'user_id', 'grade', 'description', 'logo', 'cover'
    ];

    protected $hidden = [
        'id', 'subject_id', 'major_id', 'user_id', 'created_at', 'updated_at', 'pivot'
    ];

    public $incrementing = false;

    public function subject()
    {
    	return $this->belongsTo(Subject::class);
    }

    public function getSubjectNameAttribute()
    {
        return $this->subject->name;
    }

    public function major()
    {
    	return $this->belongsTo(Major::class);
    }

    public function getMajorNameAttribute()
    {
        return $this->major->name;
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getClassNameAttribute()
    {
        return $this->grade . ' ' . $this->major->name . ' ' . $this->subject->name;
    }

    public function getTeachersAttribute()
    {
        $names = [];
        $teachers = $this->users()->where('classroom_user.role', 'teacher')->get();
        foreach ($teachers as $teacher) {
            $names[] = $teacher->fullname;
        }
        return implode(', ', $names);
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
}
