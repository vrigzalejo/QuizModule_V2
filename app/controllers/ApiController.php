<?php

use QuizModule\Interfaces\ApiInterface;

class ApiController extends \BaseController {

	private $api;

	function __construct(ApiInterface $api) {
		$this->api = $api;
	}

	public function section($id) {
		return $this->api->getSection($id);
	}

	public function student($id) {
		return $this->api->getStudent($id);
	}

	public function allTypes() {
		return $this->api->getAllTypes();
	}

	public function allSubjects() {
		return $this->api->getAllSubjects();
	}
	
	public function allSubjquizzes() {
		return $this->api->getAllSubjquizzes();
	}

	public function allQuestions() {
		return $this->api->getAllQuestions();
	}

}
