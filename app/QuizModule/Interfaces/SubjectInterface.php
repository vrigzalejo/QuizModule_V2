<?php namespace QuizModule\Interfaces;

interface SubjectInterface {
	
	public function create($input = []);
	public function all();
	public function find($id);
	public function get($count = NULL);
	public function paginate($count = NULL);
	public function update($id, input = []);
	public function delete($id);
	protected function result($success, $for, $message = NULL, $redirect = NULL);
}