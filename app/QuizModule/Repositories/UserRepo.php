<?php namespace QuizModule\Repositories;

use QuizModule\Eloquent\User;
use QuizModule\Interfaces\UserInterface;

class UserRepo extends AbstractRepository implements UserInterface {

	public function __construct(User $user) {
		parent::__construct($user);
	}

}