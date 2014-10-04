<?php namespace QuizModule\Repositories;

use QuizModule\Eloquent\Type;
use QuizModule\Interfaces\TypeInterface;

class TypeRepo extends AbstractRepository implements TypeInterface {

	public function __construct(Type $type) {
		parent::__construct($type);
	}

}