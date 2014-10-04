<?php

class SettingsController extends \BaseController {

	public function getIndex() {
		return View::make('dashboard.modules.settings.index');
	}

}
