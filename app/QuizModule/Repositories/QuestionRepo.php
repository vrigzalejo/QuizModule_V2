<?php namespace QuizModule\Repositories;

use QuizModule\Eloquent\Question;
use QuizModule\Interfaces\QuestionInterface;
use QuizModule\Validators\Questions\CreateValidator;

class QuestionRepo implements QuestionInterface {

	protected $validator;
	protected $question;

	public function __construct(
		Question $question,
		CreateValidator $validator
	) {
		$this->question = $question;
		$this->validator = $validator;
	}

	public function create($input = []) {

		if($this->validateCreate($input)) {
			$question = new Question;
			$question->type_id 		= $input["type_id"];
			$question->subject_id 	= $input["subject_id"];
			$question->question 	= $input["question"];
			$question->opt_one 		= $input["opt_one"];
			$question->opt_two 		= $input["opt_two"];
			$question->opt_three 	= $input["opt_three"];
			$question->opt_four 	= $input["opt_four"];
			$question->answer 		= $input["answer"];
			$question->is_img 		= $input["is_img"];
			$question->save();

			return $this->result(true, 'add_question', 
				'You have successfully created Question: <b>' 
				. $input["question"] 
				. '</b>, Subject: <b>' 
				. $this->find($input["subject_id"])->subj_code . '</b>');
		} else {
			return $this->result(false, 'register', 
				'You have successfully registered Student No.: <b>' 
				. $input["studentno"] 
				. '</b>, Student Name: <b>' 
				. $input["register_lastname"] 
				. ', '	
				. $input["register_firstname"] 
				. ' ' 
				. $input['register_mi']);
		}

	}

	public function createWithImg() {
		if($this->validateCreateWithImg($input)) {
			$question = new Question;
			$question->type_id 		= $input["type_id"];
			$question->subject_id 	= $input["subject_id"];
			$question->question 	= $input["question"];
			$question->opt_one 		= $input["opt_one"];
			$question->opt_two 		= $input["opt_two"];
			$question->opt_three 	= $input["opt_three"];
			$question->opt_four 	= $input["opt_four"];
			$question->answer 		= $input["answer"];
			$question->is_img 		= $input["is_img"];
			$question->save();

			return $this->result(true, 'add_question', 
				'You have successfully created Question: <b>' 
				. $input["question"] 
				. '</b>, Subject: <b>' 
				. $this->find($input["subject_id"])->subj_code . '</b>');
		} else {
			return $this->result(false, 'register', 
				'You have successfully registered Student No.: <b>' 
				. $input["studentno"] 
				. '</b>, Student Name: <b>' 
				. $input["register_lastname"] 
				. ', '	
				. $input["register_firstname"] 
				. ' ' 
				. $input['register_mi']);
		}
	}

	/**
	 * Read all
	 */
	public function all() {
		return $this->model->all();
	}
	/**
	 * Read by id
	 */	
	public function find($id) {
		return $this->model->findOrFail($id);
	}
	/**
	 * Read records per count
	 * $count = 5 by default
	 */
	public function get($count = NULL) {
		if(is_null($count))
			return $this->model->take(5)->get();
		else
			return $this->model->take($count)->get();
	}

	/**
	 * Read records and paginate
	 * $count = 5 by default
	 */
	public function paginate($count = NULL) {
		if(is_null($count))
			return $this->model->paginate(5);
		else
			return $this->model->paginate($count);
	}

	/**
	 * Update
	 */
	public function update($id, $input = []) {
		$model = $this->getById($id);
		
		return $model->fill($input)->save();
	}

	/**
	 * Delete
	 */
	public function delete($id) {
		return $this->find($id)->delete();
	}

	/**
	 * Results to be passed
	 */	
	protected function result($success, $for, $message = NULL, $redirect = NULL) {

        $result = [];
        $result["success"] = $success;
        $result["for"] = $for;

        is_null($message) ? : $result["message"] = $message;
        is_null($redirect) ? : $result["_redirect"] = $redirect;
        
        return $result;
	}

	protected function convertToImage($input, $question) {
		
	}

}