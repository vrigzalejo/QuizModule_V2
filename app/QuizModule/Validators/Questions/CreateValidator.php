<?php namespace QuizModule\Validators\Students;

use QuizModule\Validators\AbstractValidator;
use Input;

class CreateValidator extends AbstractValidator
{

    /**
     * Validation rules
     *
     * @var Array
     */

	protected $createRules = [
		'type_id'		=> 'required|integer',
		'subject_id'	=> 'required|integer',
		'question'		=> 'required',
		'opt_one'		=> 'required|alpha_spaces',
		'opt_two'		=> 'required|alpha_spaces',
		'opt_three'		=> 'required|alpha_spaces',
		'opt_four'		=> 'required|alpha_spaces',
		'answer'		=> 'required|alpha_spaces',
	];

	protected $createRulesWithImg = [
		'type_id'		=> 'required|integer',
		'subject_id'	=> 'required|integer',
		'question'		=> 'required',
		'opt_one'		=> 'regex:~[0-9a-zA-Z\+/=]{20,}~',
		'opt_two'		=> 'regex:~[0-9a-zA-Z\+/=]{20,}~',
		'opt_three'		=> 'regex:~[0-9a-zA-Z\+/=]{20,}~',
		'opt_four'		=> 'regex:~[0-9a-zA-Z\+/=]{20,}~',
		'answer'		=> 'regex:~[0-9a-zA-Z\+/=]{20,}~',
	];

}
