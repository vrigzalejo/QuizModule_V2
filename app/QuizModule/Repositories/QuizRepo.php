<?php namespace QuizModule\Repositories;

use QuizModule\Eloquent\Quiz;
use QuizModule\Interfaces\QuizInterface;

class LevelRepo extends AbstractRepository implements QuizInterface {

	public function __construct(Quiz $quiz) {
		parent::__construct($quiz);
	}

}