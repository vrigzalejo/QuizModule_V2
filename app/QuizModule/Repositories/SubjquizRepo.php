<?php namespace QuizModule\Repositories;

use QuizModule\Eloquent\Subjquiz;
use QuizModule\Interfaces\SubjquizInterface;

class SubjquizRepo extends AbstractRepository implements SubjquizInterface {

	public function __construct(Subjquiz $subjquiz) {
		parent::__construct($subjquiz);
	}

}