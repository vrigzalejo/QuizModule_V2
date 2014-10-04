<?php

class QuizzesController extends \BaseController {

	public function getIndex()
	{
		return View::make('dashboard.modules.quizzes.index');
	}

	public function getTakeAQuiz()
	{
		return View::make('dashboard.modules.takeaquiz.index');
	}


}
