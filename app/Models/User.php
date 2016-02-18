<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * Add fullname using Accessor
     * @var array
     */
    protected $appends = ['fullname'];

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
     * Accessor for Full Name
     */
    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    /**
     * Roles relationship
     */
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    /**
     * Assign new role to user
     */
    public function assignRole($role){
        if( is_string( $role ) ){
            $role = Role::where('name', $role)->first();
        }

        return $this->roles()->attach($role);
    }

    /**
     * Revoke role from user
     */
    public function revokeRole($role){
        if( is_string( $role ) ){
            $role = Role::where('name', $role)->first();
        }

        return $this->roles()->detach($role);
    }

    /**
     * Check if user hasRole
     */
    public function hasRole($name){
        foreach ($this->roles as $role) {
            if( $role->name === $name )
                return true;
        }
        return false;
    }

    /**
     * Roles relationship
     */
    public function announcements(){
        return $this->hasMany(Announcement::class);
    }
}
