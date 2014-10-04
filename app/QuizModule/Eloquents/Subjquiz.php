<?php namespace QuizModule\Eloquents;

class Subjectquiz extends AbstractEloquent {

	protected $fillable = ['subject_id', 'name'];

	public function quiz() {
		return $this->hasMany('QuizModule\Eloquents\Quiz');
	}

	public function subjquizAll() {
		return static::select(
			'subjects.id', 'subjects.subj_code', 'subjects.subj_description',
			'subjquizzes.id', 'subjquizzes.name', 'subjquizzes.created_at',
				'subjquizzes.updated_at', 'subjquizzes.deleted_at'
			)
			->leftJoin('subjects', 'subjquizzes.subject_id', '=', 'subjects.id')
			->get();
	}

}