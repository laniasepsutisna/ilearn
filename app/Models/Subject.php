<?php

namespace App\\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
	/**
	 * Fillable field
	 * @var array
	 */
    protected $fillable = ['name', 'label'];
}
