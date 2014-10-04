<?php namespace QuizModule\Validators\Students;

use QuizModule\Validators\AbstractValidator;

class CreateValidator extends AbstractValidator
{
    /**
     * Validation rules
     *
     * @var Array
     */
	protected $rules = [
		'register_studentno' => 'required|unique:users,studentno|regex:/^([0-9]{2})+([-])+([0-9]{4})([0-9]{1})?$/',
		'register_email' 	 => 'email|unique:users,email',
		'password'			 => 'required|min:8|confirmed',
		'password_confirmation' => 'required|min:8',
		'register_lastname'  => 'required|alpha',
		'register_firstname' => 'required|alpha',
		'register_mi'		 => 'required|alpha|max:3',
		'register_level'	 => 'required',
		'register_section'	 => 'required'
		
	];

}
