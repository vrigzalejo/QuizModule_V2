<?php namespace QuizModule\Repositories;

abstract class AbstractRepository {

	protected $model;

	public function __construct($model = NULL) {
		
		if(is_null($model)) {
			throw new Exception;
		}
		$this->model = $model;
	}


	/**
	 * Create
	 */
	public function create($input = []) {
		return $this->model->newInstance($input)->save();
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



	public function result($success, $for, $message = NULL, $redirect = NULL) {

        $result = [];
        $result["success"] = $success;
        $result["for"] = $for;

        is_null($message) ? : $result["message"] = $message;
        is_null($redirect) ? : $result["_redirect"] = $redirect;
        
        return $result;
	}
}