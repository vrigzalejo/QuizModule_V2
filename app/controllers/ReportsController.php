<?php

class ReportsController extends \BaseController {

	public function getIndex() {
		return View::make('dashboard.modules.reports.index');
	}

}
