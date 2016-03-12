<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
	protected $fillable = ['id', 'subject_id', 'major_id', 'grade', 'logo', 'cover'];

    public function subjects()
    {
    	return $this->belongsTo(Subject::class);
    }

    public function majors()
    {
    	return $this->belongsTo(Major::class);
    }

    public function users()
    {
    	return $this->belongsToMany(Subject::class);
    }

    public function getNameAttribute()
    {
        return $this->grade . ' ' . $this->majors->name . ' ' . $this->subjects->name;
    }

}
