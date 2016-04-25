<?php

namespace App\Models;

use App\Models\Discussion;
use App\Traits\UserMetaAccessor;
use App\Traits\UuidModel;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
	use UuidModel, CanResetPassword, UserMetaAccessor;

	public $incrementing = false;

	protected $appends = [
		'fullname', 'picture_md', 'picture_sm', 'cover_sm'
	];

	protected $fillable = [
		'no_induk', 'username', 'firstname', 'lastname', 'email', 'role', 'password', 'status'
	];

	protected $hidden = [
		'id', 'password', 'pivot', 'remember_token', 'created_at', 'updated_at'
	];

	public function getFullnameAttribute()
	{
		return $this->firstname . ' ' . $this->lastname;
	}

	public function announcements()
	{
		return $this->hasMany('App\Models\Announcement');
	}

	public function usermeta()
	{
		return $this->hasOne('App\Models\UserMeta');
	}

	public function teacherclassrooms()
	{
		return $this->hasMany('App\Models\Classroom', 'teacher_id');
	}

	public function classrooms()
	{
		return $this->belongsToMany('App\Models\Classroom');
	}

	public function teacherassignments()
	{
		return $this->hasMany('App\Models\Assignment');
	}

	public function teachercourses()
	{
		return $this->hasMany('App\Models\Course');
	}

	public function submissions()
	{
		return $this->belongsToMany('App\Models\Assignment', 'submissions');
	}

	public function getRoleNameAttribute(){
		switch ($this->role) {
			case 'staff':
				return 'Tata Usaha';
				break;

			case 'teacher':
				return 'Guru';
				break;

			case 'student':
				return 'Siswa';
				break;

			default:
				return 'Siswa';
				break;
		}
	}

	public function hasRole($name)
	{
		if(is_array($name)) {
			foreach ($name as $roleName) {
				if( $this->role === $roleName ) {
					return true;
				}
			}
		} else{
			if( $this->role === $name ) {
				return true;
			}
		}
		return false;
	}

	public function scopeOnlineusers($query)
	{
		return $query->where('login', 1)->where('role', '<>', 'staff')->where('id', '<>', Auth::user()->id);
	}
}
