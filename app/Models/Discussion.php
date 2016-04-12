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

    protected $hidden = [ 
        'comments'
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function($model){
            foreach ($model->comments as $comment) {
                if($comment) {
                    $comment->delete();
                }
            }
        });
    }

    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }

    public function comments()
    {
    	return $this->hasMany('App\Models\Discussion', 'parent_id')->orderBy('created_at', 'DESC');
    }
}
