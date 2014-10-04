<?php namespace QuizModule\Eloquents;

class Question extends AbstractEloquent {

	public function type() {
		return $this->belongsTo('QuizModule\Eloquents\Type');
	}

	public function subject() {
		return $this->belongsTo('QuizModule\Eloquents\Subject');
	}

	public function questionAll() {
		return static::select(
			'types.id','types.value',
			'subjects.id','subjects.subj_code','subjects.subj_description',
			'questions.id',
			'questions.question',
			'questions.opt_one',
			'questions.opt_two',
			'questions.opt_three',
			'questions.opt_four',
			'questions.answer',
			'questions.is_img',
			'questions.created_at','questions.updated_at','questions.deleted_at'

			)
			->leftJoin('types','questions.type_id','=','types.id')
			->leftJoin('subjects','questions.subject_id','=','subjects.id')
			->get();
	}	

}