<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	// Added for csrf protection using AJAX request
	$token = Request::ajax() ? Request::header('X-CSRF-Token') : Input::get('_token');
	//if (Session::token() != Input::get('_token'))
	if (Session::token() != $token) {
		throw new Illuminate\Session\TokenMismatchException;
	}
});

Route::filter('sentry.auth', function() {
	if(!Sentry::check()) {
		return Redirect::to('/');
	}
});

Route::filter('superadmin.access', function() {
	if(!Sentry::getUser()->hasAccess('system'))  {
		return Redirect::to('/');
	} 
	
});

Route::filter('prof.access', function() {
	if(!Sentry::getUser()->hasAccess('system.prof'))  {
		return Redirect::to('/');
	} 
	
});

Route::filter('student.access', function() {
	if(!Sentry::getUser()->hasAccess('system.student'))  {
		return Redirect::to('/');
	} 
	
});

Route::filter('response', function($route, $request, $response) {
		//The request status is over 300, error, return normal action
	if ($response->getStatusCode() >= 300) return;

	//Otherwise, if request is an ajax request
	if ( !( $request->ajax() || $request->wantsJson() || $request->isJson() ) ) {

		//Send proper HTML header
		$response->headers->set('Content-Type', 'text/html') ;

		//Set the response content to be the home view
		$response->setContent(View::make('login.index')->render());

		return $response ;
	}
});