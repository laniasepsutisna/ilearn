<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidModel;

class MultipleChoice extends Model
{
	use UuidModel;

	protected $table = 'mc_questions';

	public $incrementing = false;
		
	protected $fillable = [
		'quiz_id', 'question', 'image'
	];

	public function answers()
	{
		return $this->hasMany('App\Models\MultipleChoiceAnswer', 'question_id');
	}
}
