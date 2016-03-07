<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidModel;

class User extends Authenticatable
{
    use UuidModel, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $appends = ['fullname', 'rolename'];

    public $incrementing = false;

    protected $fillable = [
        'identitynumber', 'username', 'firstname', 'lastname', 'email', 'password', 'status',
    ];

    protected $hidden = [
        'id', 'password', 'remember_token',
    ];

    public static function boot(){
        parent::boot();

        static::deleting(function($model) {
            $model->roles()->detach();
        });
    }

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
            return $role->name;
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

    public function setDateOfBirth($date)
    {
        return $this->attributes['dateofbirth'] = \Carbon\Carbon::createFromFormat('d-m-Y', $date)->toDateString();
    }

    public function getDateOfBirthAttribute($date)
    {
        return \Carbon\Carbon::createFormatFrom('Y-m-d', $date)->format('d-m-Y');
    }
}
