<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    /**
     * Use SoftDelete trait
     */
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Add fullname using Accessor
     * @var array
     */
    protected $appends = ['fullname'];

    /**
     * Prevent incrementing in ID
     * We are using UUID
     * @var string
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identity_number', 'username', 'firstname', 'lastname', 'email', 'password', 'status',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * Fullname Accessor
     * @return string combined 2 string
     */
    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    /**
     * Roles relationship
     * @return array
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get roles lists
     * @return array
     */
    public function getRoleListsAttribute()
    {
        if ($this->roles()->count() < 1) {
            return null;
        }
        return $this->roles->lists('id')->all();
    }

    /**
     * Assign new role to user
     * @param  string, int
     * @return
     */
    public function assignRole($role)
    {
        if( is_string( $role ) ){
            $role = Role::where('name', $role)->first();
        }

        return $this->roles()->attach($role);
    }

    /**
     * Remove role from user
     * @param  string or int
     * @return
     */
    public function revokeRole($role)
    {
        if( is_string( $role ) ){
            $role = Role::where('name', $role)->first();
        }

        return $this->roles()->detach($role);
    }

    /**
     * Check current user role
     * @param  string
     * @return boolean
     */
    public function hasRole($name)
    {
        foreach ($this->roles as $role) {
            if( $role->name === $name )
                return true;
        }
        return false;
    }

    /**
     * Announcements Relationship
     * @return array
     */
    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    /**
     * User identity
     * @return array
     */
    public function usermeta()
    {
        return $this->hasOne(Announcement::class);
    }
}
