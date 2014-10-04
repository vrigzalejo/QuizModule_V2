<?php namespace QuizModule\Repositories;

use QuizModule\Eloquent\Level;
use QuizModule\Eloquent\Student;
use QuizModule\Eloquent\Subject;
use QuizModule\Eloquent\Type;
use QuizModule\Eloquent\Subjquiz;
use QuizModule\Eloquent\Question;
use QuizModule\Interfaces\ApiInterface;

class ApiRepository extends AbstractRepository implements ApiInterface {

	public function getSection($id) {
		return Level::find($id)->section;		
	}

	public function getStudent($id) {
		return Student::studentsBySection($id);
	}

	public function getAllTypes() {
		return Type::all();
	}

	public function getAllSubjects() {
		return Subject::all();
	}

	public function getAllSubjquizzes() {
		return Subjquiz::subjquizAll();
	}

	public function getAllQuestions() {
		return Question::questionAll();
	}

}