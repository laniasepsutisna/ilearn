<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidModel;

class Discussion extends Model
{
    use UuidModel;

    public $incrementing = false;

	protected $fillable = [
        'id', 'classroom_id', 'parent_id', 'user_id', 'content',
    ];

    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }
}
