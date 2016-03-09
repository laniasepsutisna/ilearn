<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidModel;

class User extends Authenticatable
{
    use SoftDeletes, UuidModel, CanResetPassword;

    protected $dates = ['deleted_at'];

    protected $appends = ['fullname', 'rolename'];

    public $incrementing = false;

    protected $fillable = [
        'identitynumber', 'username', 'firstname', 'lastname', 'email', 'password', 'status',
    ];

    protected $hidden = [
        'id', 'password', 'remember_token', 'deleted_at'
    ];

    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getRoleAttribute()
    {
        if ($this->roles()->count() < 1) {
            return null;
        }
        return $this->roles->lists('id')->all();
    }

    public function getRoleNameAttribute(){
        foreach ($this->roles as $role) {
            switch ($role->name) {
                case 'maddog':
                    return 'Administrator';
                    break;

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
    }

    public function assignRole($role)
    {
        if( is_string( $role ) ){
            $role = Role::where('name', $role)->first();
        }

        return $this->roles()->attach($role);
    }

    public function revokeRole($role)
    {
        if( is_string( $role ) ){
            $role = Role::where('name', $role)->first();
        }

        return $this->roles()->detach($role);
    }

    public function hasRole($name)
    {
        foreach ($this->roles as $role) {
            if($role->name === $name)
                return true;
        }
        return false;
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function usermetas()
    {
        return $this->hasOne(UserMeta::class);
    }

    public function getDateOfBirthAttribute()
    {
        return $this->usermetas->dateofbirth;
    }

    public function getTelpNoAttribute()
    {
        return $this->usermetas->telp_no;
    }

    public function getParentTelpNoAttribute()
    {
        return $this->usermetas->parent_telp_no;
    }

    public function getAddressAttribute()
    {
        return $this->usermetas->address;
    }

    public function getPictureAttribute()
    {
        if ($this->usermetas->picture !== '') {
            return url('/uploads/' . $this->usermetas->picture);
        } else {
            return 'http://placehold.it/160x160';
        }
    }
}
