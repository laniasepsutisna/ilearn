<?php

namespace App\Models;

use App\Traits\UuidModel;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use UuidModel, CanResetPassword;
    
    public $incrementing = false;

    protected $appends = [
        'fullname', 'picture'
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
        if($this->role === $name){
            return true;
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

    public function getAngkatanAttribute()
    {
        return $this->usermeta->angkatan;
    }

    public function getMajorAttribute()
    {
        return $this->usermeta->major;
    }

    public function getDateOfBirthAttribute()
    {
        return $this->usermeta->dateofbirth;
    }

    public function getTelpNoAttribute()
    {
        return $this->usermeta->telp_no;
    }

    public function getParentTelpNoAttribute()
    {
        return $this->usermeta->parent_telp_no;
    }

    public function getAddressAttribute()
    {
        return $this->usermeta->address;
    }

    public function getPictureAttribute()
    {
        if ($this->usermeta->picture !== '') {
            return url('/uploads/' . $this->usermeta->picture);
        }
    }

    public function getCoverAttribute()
    {
        if ($this->usermeta->cover !== '') {
            return url('/uploads/' . $this->usermeta->cover);
        }
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
