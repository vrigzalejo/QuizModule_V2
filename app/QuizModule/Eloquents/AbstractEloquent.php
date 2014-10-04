<?php namespace QuizModule\Eloquents;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

abstract class AbstractEloquent extends \Eloquent {

	use SoftDeletingTrait;

	// protected $softDeletes = true;

}