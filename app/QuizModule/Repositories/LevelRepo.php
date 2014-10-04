<?php namespace QuizModule\Repositories;

use QuizModule\Eloquent\Level;
use QuizModule\Interfaces\LevelInterface;

class LevelRepo extends AbstractRepository implements LevelInterface {

	public function __construct(Level $level) {
		parent::__construct($level);
	}

}