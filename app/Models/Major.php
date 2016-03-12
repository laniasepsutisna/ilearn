<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
	protected $fillable = ['name', 'description'];

    public function classrooms()
    {
    	return $this->belongsTo(Classroom::class);
    }
}
