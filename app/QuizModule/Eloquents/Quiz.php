<?php namespace QuizModule\Eloquents;

class Quiz extends AbstractEloquent {

	public function student() {
		return $this->belongsTo('QuizModule\Eloquents\Student');
	}

	public function subjquiz() {
		return $this->belongsTo('QuizModule\Eloquents\Subjquiz');
	}

}