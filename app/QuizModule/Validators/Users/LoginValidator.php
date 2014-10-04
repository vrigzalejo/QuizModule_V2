<?php namespace QuizModule\Validators\Users;

use QuizModule\Validators\AbstractValidator;

class LoginValidator extends AbstractValidator
{
    /**
     * Validation rules
     *
     * @var Array
     */
    protected $rules = [
        'studentno'      => 'required|exists:users,studentno',
        'login_password' => 'required'
    ];

}
