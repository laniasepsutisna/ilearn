<?php

namespace App\Traits;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait UuidModel
{
	public static function bootUuidModel()
	{
        static::creating(function($model){
            $id = $model->getKeyName();
            if(empty($model->$id)){
                $model->$id = Uuid::uuid4()->toString();
            }
        });

        static::saving(function($model) {
            $id = $model->getKeyName();
        	$original_uuid = $model->getOriginal($id);

        	if ($original_uuid !== $model->$id) {
            	$model->$id = $original_uuid;
        	}
    	});
	}
}