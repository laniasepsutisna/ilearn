<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidModel;

class Subject extends Model
{

    use UuidModel;

    public $incrementing = false;
    
    protected $fillable = [
    	'name', 'description'
    ];

	protected $hidden = [
		'id', 'created_at', 'updated_at'
	];
}
