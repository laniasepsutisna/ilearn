<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidModel;
use Carbon\Carbon;

class Announcement extends Model
{
	use UuidModel;

    public $incrementing = false;

    public $append = ['urgensi'];
    
	protected $fillable = [
		'user_id', 'title', 'content', 'status'
	];

	protected $hidden = [
		'user_id', 'created_at', 'updated_at'
	];

    public function users()
    {
    	return $this->belongsTo('App\Models\User');
    }

    public function getUrgensiAttribute()
    {
    	switch ($this->status) {
    		case 'danger':
    			return 'Penting';
    			break;
    		
    		default:
    			return 'Hanya info';
    			break;
    	}
    }

    public function getHumanTimeAttribute()
    {
        $now = Carbon::now();
        $created = Carbon::parse($this->created_at);

        if( $created->lt($now) ) {
            return $created->diffForHumans();
        } else {
            return $created->format('l jS F Y h:i:s A');
        }
    }
}
