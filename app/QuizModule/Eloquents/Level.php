<?php namespace QuizModule\Eloquents;

class Level extends AbstractEloquent {

	public function section() {
		return $this->hasMany('QuizModule\Eloquents\Section');
	}

}