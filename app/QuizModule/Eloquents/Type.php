<?php namespace QuizModule\Eloquents;

class Type extends AbstractEloquent {

	protected $fillable = ['subject_id', 'name'];

	public function quiz() {
		return $this->hasMany('QuizModule\Eloquents\Quiz');
	}

	public function question() {
		return $this->hasMany('QuizModule\Eloquents\Question');
	}

}