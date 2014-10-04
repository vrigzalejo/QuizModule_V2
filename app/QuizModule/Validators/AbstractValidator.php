<?php namespace QuizModule\Validators;

use Validator;
use QuizModule\Interfaces\ValidableInterface;

abstract class AbstractValidator {

    private $validator;

    public function __construct(Validator $validator) {
        $this->validator = $validator;
    }

    private function validate($inputs, $rules)
    {
        $validation = $this->validator->make($inputs, $rules);

        if($validation->fails())
            return false;

        return true;
    }

    public function validateCreate($inputs)
    {
        return $this->validate($inputs, $this->createRules);
    }

    public function validateUpdate($inputs)
    {
        return $this->validate($inputs, $this->updateRules);
    }

    public function validateCreateWithImg($inputs) {
        return $this->validate($inputs, $this->createRulesWithImg);
    }

    public function validateUpdateWithImg($inputs) {
        return $this->validate($inputs, $this->updateRulesWithImg);
    }

}
