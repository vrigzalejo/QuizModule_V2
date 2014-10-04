<?php namespace QuizModule\Facades;

use Illuminate\Support\Facades\Facade as IlluminateFacade;

class UMSFacade extends IlluminateFacade {

    protected static function getFacadeAccessor() { return 'qm'; 
	}

}