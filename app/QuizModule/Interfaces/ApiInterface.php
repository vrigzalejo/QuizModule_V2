<?php namespace QuizModule\Interfaces;

interface ApiInterface {
	
	public function getSection($id);

	public function getStudent($id);

	public function getAllTypes();

	public function getAllSubjects();

	public function getAllSubjquizzes();

	public function getAllQuestions();

}