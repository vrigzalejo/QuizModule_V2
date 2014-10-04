<?php namespace QuizModule\Repositories;

use QuizModule\Eloquent\Section;
use QuizModule\Interfaces\SectionInterface;

class SectionRepo extends AbstractRepository implements SectionInterface {

	public function __construct(Section $section) {
		parent::__construct($section);
	}

}