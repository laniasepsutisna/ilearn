<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
	protected $fillable = ['name', 'description'];

	protected $hidden = [
		'id', 'created_at', 'updated_at'
	];

    public function classrooms()
    {
    	return $this->hasMany(Classroom::class);
    }
}
