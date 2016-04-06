<?php

namespace App\Models;

use App\Traits\UuidModel;
use App\Traits\UserMetaAccessor;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use UuidModel, CanResetPassword, UserMetaAccessor;
    
    public $incrementing = false;

    protected $appends = [
        'fullname', 'picture_md', 'picture_sm', 'cover_sm'
    ];

    protected $fillable = [
        'no_induk', 'username', 'firstname', 'lastname', 'email', 'role', 'password', 'status',
    ];

    protected $hidden = [
        'id', 'password', 'pivot', 'remember_token', 'created_at', 'updated_at'
    ];

    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
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
        }

        return false;
    }



    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function usermeta()
    {
        return $this->hasOne(UserMeta::class);
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class);
    }

    public function getGroupAttribute()
    {
        $classrooms = '';
        foreach ($this->classrooms as $classroom) {
            $classrooms[$classroom->id] = $classroom->classname;
        }

        return $classrooms;
    }

}
