<?php namespace QuizModule\Repositories;

use QuizModule\Eloquent\Setting;
use QuizModule\Interfaces\SettingInterface;

class SettingRepo extends AbstractRepository implements SettingInterface {

	public function __construct(Setting $setting) {
		parent::__construct($setting);
	}

}