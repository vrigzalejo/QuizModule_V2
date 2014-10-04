<?php namespace QuizModule\Repositories;

use QuizModule\Eloquent\Student;
use QuizModule\Eloquent\Level;
use QuizModule\Eloquent\Section;
use QuizModule\Interfaces\StudentInterface;
use QuizModule\Validators\Students\CreateValidator;
use QM, DateTime;

class StudentRepo implements StundentInterface {

	protected $validator;
	protected $student;
	protected $level;
	protected $section;

	public function __construct(
		Student $student,
		Level $level,
		Section $section,
		CreateValidator $validator
	) {
		$this->student = $student;
		$this->level = $level;
		$this->section = $section;
		$this->validator = $validator;
	}

	public function create($input = []) {

		$user = QM::register($input, true);
		$studentGroup = QM::findGroupByName('Student');
		$user->addGroup($studentGroup);

		if($this->validateCreate($input)) {
			Student::create([
			'user_id'	=> QM::findUserByLogin($input["studentno"])->getId(),
			'email'		=> $input["register_email"],
			'studentno' => $input["register_studentno"],
			'lastname'  => $input["register_lastname"],
			'firstname' => $input["register_firstname"],
			'mi' 		=> $input["register_mi"],
			'level'		=> $this->level->find($input["register_level"])->level,
			'section'	=> $this->section->find($input["register_section"])->section,
			'created_at' => new DateTime,
			'updated_at' => new DateTime
			]);
		} else {
			return $this->result(true, 'register', 'You have successfully registered Student No.: <b>' 
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


}