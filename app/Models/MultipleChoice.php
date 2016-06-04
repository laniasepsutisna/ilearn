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

	public function answer()
	{
		return $this->hasOne('App\Models\MultipleChoiceAnswer', 'question_id');
	}

	public function getAnswer1Attribute()
	{
		return $this->answer->answer_1;
	}

	public function getAnswer2Attribute()
	{
		return $this->answer->answer_2;
	}

	public function getAnswer3Attribute()
	{
		return $this->answer->answer_3;
	}

	public function getAnswer4Attribute()
	{
		return $this->answer->answer_4;
	}

	public function getCorrectAnswerAttribute()
	{
		return $this->answer->correct_answer;
	}
}
