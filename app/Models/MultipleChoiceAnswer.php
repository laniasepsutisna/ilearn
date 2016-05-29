<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidModel;

class MultipleChoiceAnswer extends Model
{
	use UuidModel;

	protected $table = 'mc_answers';

	public $incrementing = false;
	
	public $timestamps = false;
	
	protected $fillable = [
		'question_id', 'answer_1', 'answer_2', 'answer_3', 'answer_4'
	];
}
