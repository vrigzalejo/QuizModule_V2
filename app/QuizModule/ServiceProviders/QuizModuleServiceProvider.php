<?php namespace QuizModule\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class QuizModuleServiceProvider extends ServiceProvider {

	protected $defer = true;

	/**
	 * Bind repositories and interfaces
	 */
	public function register() {

		$this->app['qm'] = $this->app->share(function($app) {

			// Once the authentication service has actually been requested by the developer
            // we will set a variable in the application indicating such. This helps us
            // know that we need to set any queued cookies in the after event later.
    		$app['sentry.loaded'] = true;

    		return new QM(
    			$app['sentry.user'],
    			$app['sentry.group'],
    			$app['sentry.throttle'],
                $app['sentry.session'],
                $app['sentry.cookie'],
                $app['request']->getClientIp()
    		);
		});

		// Bind Level's repository and interface
		$this->app->bind(
			'QuizModule\Interfaces\LevelInterface',
			'QuizModule\Repositories\LevelRepo'
		);

		// Bind Question's repository and interface
		$this->app->bind(
			'QuizModule\Interfaces\QuestionInterface',
			'QuizModule\Repositories\QuestionRepo'
		);

		// Bind Quiz's repository and interface
		$this->app->bind(
			'QuizModule\Interfaces\QuizInterface',
			'QuizModule\Repositories\QuizRepo'
		);

		// Bind Section's repository and interface
		$this->app->bind(
			'QuizModule\Interfaces\SectionInterface',
			'QuizModule\Repositories\SectionRepo'
		);

		// Bind Setting's repository and interface
		$this->app->bind(
			'QuizModule\Interfaces\SettingInterface',
			'QuizModule\Repositories\SettingRepo'
		);

		// Bind Student's repository and interface
		$this->app->bind(
			'QuizModule\Interfaces\StudentInterface',
			'QuizModule\Repositories\StudentRepo'
		);

		// Bind Subject's repository and interface
		$this->app->bind(
			'QuizModule\Interfaces\SubjectInterface',
			'QuizModule\Repositories\SubjectRepo'
		);

		// Bind Subjquiz's repository and interface
		$this->app->bind(
			'QuizModule\Interfaces\SubjquizInterface',
			'QuizModule\Repositories\SubjquizRepo'
		);

		// Bind Type's repository and interface
		$this->app->bind(
			'QuizModule\Interfaces\TypeInterface',
			'QuizModule\Repositories\TypeRepo'
		);

		// Bind User's repository and interface
		$this->app->bind(
			'QuizModule\Interfaces\UserInterface',
			'QuizModule\Repositories\UserRepo'
		);

		// Bind User's repository and interface
		$this->app->bind(
			'QuizModule\Interfaces\ApiInterface',
			'QuizModule\Repositories\ApiRepo'
		);

	}

	public function provides() {
        return array('qm');
    }
}