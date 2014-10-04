<?php namespace QuizModule\Repositories;

use QuizModule\Eloquent\Subject;
use QuizModule\Interfaces\SubjectInterface;

class SubjectRepo extends AbstractRepository implements SubjectInterface {

	public function __construct(Subject $subject) {
		parent::__construct($subject);
	}

}