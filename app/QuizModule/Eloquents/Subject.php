<?php namespace QuizModule\Eloquents;

class Subject extends AbstractEloquent {

	public function quiz() {
		return $this->hasManyThrough('QuizModule\Eloquents\Quiz', 'QuizModule\Eloquents\Subjquiz');
	}

	public function question() {
		return $this->hasMany('QuizModule\Eloquents\Question');
	}

}