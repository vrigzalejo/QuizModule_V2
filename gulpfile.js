'use strict';
/**
 * Node modules
 */
var gulp 			= require('gulp'),
	bowerPkg		= require('./bower.json'),
	// bower 			= require('bower'),
	/**
	 * @plugins
	 * - loaded plugins from package.json
	 * - camelCase is true by default (e.g. 'minifyCss' instead of 'gulp-minify-css')
	 * - 'gulp-' prefix was removed when calling a plugin 
	 * - don't use snake-case
	 */
	plugins 		= require('gulp-load-plugins')();

/**
 * Directories
 */
var _assets = {
		angular					: 'app/assets/public/libs/angular/',
		angularApp 				: 'app/assets/app/',
		angularAnimate			: 'app/assets/public/libs/angular-animate/',
		angularCookies			: 'app/assets/public/libs/angular-cookies/',
		angularMocks			: 'app/assets/public/libs/angular-mocks/',
		angularResource			: 'app/assets/public/libs/angular-resource/',
		angularLoadingBar		: 'app/assets/public/libs/angular-loading-bar/',
		angularRoute			: 'app/assets/public/libs/angular-route/',
		angularSanitize			: 'app/assets/public/libs/angular-sanitize/',
		angularScenario			: 'app/assets/public/libs/angular-scenario/',
		angularTouch			: 'app/assets/public/libs/angular-touch/',
		bootstrap 				: 'app/assets/public/libs/bootstrap/',
		fastclick				: 'app/assets/public/libs/fastclick/',
		fontAwesome 			: 'app/assets/public/libs/font-awesome/',
		foundation 				: 'app/assets/public/libs/foundation/',
		foundationDatePicker	: 'app/assets/public/libs/foundation-datepicker',
		jquery 					: 'app/assets/public/libs/jquery/',
		jqueryPlaceholder 		: 'app/assets/public/libs/jquery-placeholder/',
		jqueryNicescroll 		: 'app/assets/public/libs/jquery-nicescroll/',
		lightbox 				: 'app/assets/public/libs/lightbox/',
		modernizr 				: 'app/assets/public/libs/modernizr/',
		html5shiv				: 'app/assets/public/libs/html5shiv/dist/',
		nprogress 				: 'app/assets/public/libs/nprogress/',
		responsiveTables 		: 'app/assets/public/libs/responsive-tables/'
};

/**
 * Paths
 */
var _scss = {
		foundation 				: _assets.foundation + 'scss/**/*.scss',
		fontAwesome 			: _assets.fontAwesome + 'scss/*.scss'
};
var _less = {
		bootstrap 				: _assets.bootstrap + 'less/bootstrap.less'
};
var _css = {
		bootstrap 				: _assets.bootstrap + 'dist/css/bootstrap.css',
		foundationDatePicker 	: _assets.foundationDatePicker + 'stylesheets/foundation-datepicker.css',
		lightbox 				: _assets.lightbox + 'css/lightbox.css',
		nprogress 				: _assets.nprogress + 'nprogress.css',
		responsiveTables 		: _assets.responsiveTables + 'responsive-tables.css'
};
var _fonts = {
		fontAwesome 			: _assets.fontAwesome + 'fonts/*.*',
		bootstrap 				: _assets.bootstrap + 'dist/fonts/*.*'
};
var _js = {
		angular 				: _assets.angular + 'angular.min.js',
		foundation 				: _assets.foundation + 'js/foundation.min.js',
		foundationModules 		: _assets.foundation + 'js/foundation/*.js',
		bootstrap 				: _assets.bootstrap + 'dist/js/bootstrap.min.js',
		bootstrapModules		: _assets.bootstrap + 'js/*.js',
		jquery 					: _assets.jquery + 'dist/jquery.min.js',	
		fastclick 				: _assets.fastclick + 'lib/fastclick.js',
		foundationDatePicker 	: _assets.foundationDatePicker + 'js/*.js',
		jqueryPlaceholder 		: _assets.jqueryPlaceholder + '*.js',
		jqueryNicescroll 		: _assets.jqueryNicescroll + 'jquery-nicescroll.min.js',
		lightbox 				: _assets.lightbox + 'js/lightbox.js',
		modernizr 				: _assets.modernizr + 'modernizr.js',
		html5shiv 				: _assets.html5shiv + 'html5shiv.min.js',
		nprogress 				: _assets.nprogress + 'nprogress.js',
		responsiveTables 		: _assets.responsiveTables + 'responsive-tables.js'
};
var _app = {
		views 					: 'app/views/**/*.php',
		angularApp 				: 'app/assets/app/**/*.*'
};

var appName = 'public/' + bowerPkg.name +"/" || 'public/app/',
	_dest = {
		css 					: 'public/assets/css/',
		fonts 					: 'public/assets/fonts/',
		js 						: 'public/assets/js/',
		img 					: 'public/assets/img/',
		app 					: appName
};

var _pkg = {
		bower 					: './bower.json',
		npm 					: './package.json'	
};


/**
 * Dependency messages
 */
var _bootstrap = {
	'jQuery'				: 'if (typeof jQuery === \'undefined\') { throw new Error(\'Bootstrap\\\'s JavaScript requires jQuery\') }\n\n'
};

/**
 * Install Bower and NPM packages
 */
gulp.task('install', function() {
	return gulp.src([_pkg.bower, _pkg.npm])
		.pipe(plugins.install())
		.pipe(plugins.notify({ message: 'Bower and NPM packages installed.' }));
});

/**
 * Angular app, and assets
 */
gulp.task('angular:app:js', function() {
	return gulp.src(_assets.angularApp + 'scripts/**/*.js')
		.pipe(plugins.concat('angular-app.js'))
		.pipe(plugins.uglify({ compress: true, keepSpecialComments: 0 }))
		.pipe(plugins.rename({ suffix: '.min' })) 
		.pipe(gulp.dest(_dest.app + 'scripts'));
});
gulp.task('angular:app:html', function() {
	return gulp.src(_assets.angularApp + 'views/*.html')
		.pipe(plugins.minifyHtml({ spare: true }))
		.pipe(gulp.dest(_dest.app + 'views'));
});

gulp.task('angular:modules:js', function() {
	return gulp.src([
		_assets.angularAnimate + 'angular-animate.min.js',
		_assets.angularCookies + 'angular-cookies.min.js',
		_assets.angularResource + 'angular-resource.min.js',
		_assets.angularRoute + 'angular-route.min.js',
		_assets.angularSanitize + 'angular-sanitize.min.js',
		_assets.angularTouch + 'angular-touch.min.js',
		_assets.angularLoadingBar + 'src/loading-bar.js'
	])
	.pipe(plugins.concat('angular-modules.js'))
	.pipe(plugins.uglify({ compress: true, keepSpecialComments: 0 }))
	.pipe(plugins.rename({ suffix: '.min' })) 
	.pipe(gulp.dest(_dest.js));
});

gulp.task('angular:modules:css', function() {
	return gulp.src(
		_assets.angularLoadingBar + 'src/loading-bar.css'
	)
	.pipe(plugins.minifyCss({ keepSpecialComments: 0 }))
	.pipe(plugins.concat('angular-modules.css'))
	.pipe(plugins.rename({ suffix: '.min' })) 
	.pipe(gulp.dest(_dest.css));
})

/**
 * Header scripts
 */
gulp.task('header:scripts', function() {
	return gulp.src([
		_js.angular,
		_js.modernizr,
		_js.html5shiv
	])
	.pipe(plugins.concat('header-scripts.js'))
	.pipe(plugins.uglify({ compress: true, keepSpecialComments: 0 }))
	.pipe(plugins.rename({ suffix: '.min' })) 
	.pipe(gulp.dest(_dest.js));
})

/**
 * Foundation assets
 */
gulp.task('foundation:scss', function() {
	return gulp.src(_scss.foundation)
		.pipe(plugins.sass({ outputStyle: 'compressed', includePaths: _assets.foundation + 'scss' }))
		.pipe(plugins.autoprefixer('last 2 version', 'safari 5', 'ie 9', 'ios 6', 'android 4'))
		.pipe(plugins.rename({ suffix: '.min' }))
		.pipe(plugins.minifyCss({ keepSpecialComments: 0 }))
		.pipe(gulp.dest(_dest.css));
});
gulp.task('foundation:js', function() {
	return gulp.src(_js.foundation)
		.pipe(plugins.uglify({ compress: true, keepSpecialComments: 0 }))
		// .pipe(plugins.rename({ suffix: '.min' })) 
		.pipe(gulp.dest(_dest.js));
});
gulp.task('foundation:modules:js', function() {
	return gulp.src(_js.foundationModules)
		.pipe(plugins.concat('foundation-modules.js'))
		.pipe(plugins.uglify({ compress: true, keepSpecialComments: 0 }))
		.pipe(plugins.rename({ suffix: '.min' })) 
		.pipe(gulp.dest(_dest.js));
});

/**
 * FontAwesome assets
 */
gulp.task('fontAwesome:scss', function() {
	return gulp.src(_scss.fontAwesome)
		.pipe(plugins.sass({ outputStyle: 'compressed', includePaths: _assets.fontAwesome + 'scss' }))
		.pipe(plugins.autoprefixer('last 2 version', 'safari 5', 'ie 9', 'ios 6', 'android 4'))
		.pipe(plugins.rename({ suffix: '.min' }))
		.pipe(plugins.minifyCss({ keepSpecialComments: 0 }))
		.pipe(gulp.dest(_dest.css));
});
gulp.task('fontAwesome:fonts', function() {
	return gulp.src(_fonts.fontAwesome)
		.pipe(gulp.dest(_dest.fonts));
});

/**
 * Bootstrap assets
 */
gulp.task('bootstrap:less', function() {
	return gulp.src(_less.bootstrap)
		.pipe(plugins.less({ outputStyle: 'compressed', includePaths: _assets.fontAwesome + 'less' }))
		.pipe(plugins.autoprefixer('last 2 version', 'safari 5', 'ie 9', 'ios 6', 'android 4'))
		.pipe(plugins.rename({ suffix: '.min' }))
		.pipe(plugins.minifyCss({ keepSpecialComments: 0 }))
		.pipe(gulp.dest(_dest.css));
});
gulp.task('bootstrap:fonts', function() {
	return gulp.src(_fonts.bootstrap)
		.pipe(gulp.dest(_dest.fonts));
});
gulp.task('bootstrap:modules:js', function() {
	return gulp.src(_js.bootstrapModules)
		.pipe(plugins.concat('bootstrap-modules.js'))
		.pipe(plugins.uglify({ compress: true, keepSpecialComments: 0 }))
		.pipe(plugins.rename({ suffix: '.min' })) 
		.pipe(gulp.dest(_dest.js));
});
gulp.task('bootstrap:js', function() {
	return gulp.src(_js.bootstrap)
		.pipe(plugins.uglify({ compress: true, keepSpecialComments: 0 }))
		// .pipe(plugins.rename({ suffix: '.min' })) 
		.pipe(gulp.dest(_dest.js));
});

/**
 * JQuery and JQuery plugins assets
 */
gulp.task('jquery:js', function() {
	return gulp.src(_js.jquery)
		.pipe(plugins.uglify({ compress: true, keepSpecialComments: 0 }))
		// .pipe(plugins.rename({ suffix: '.min' })) 
		.pipe(gulp.dest(_dest.js));
});
gulp.task('jquery:plugins:js', function() {
	return gulp.src([
		_js.foundationDatePicker,
		_js.jqueryPlaceholder,
		_js.lightbox,
		_js.nprogress,
		_js.responsiveTables,
		_js.fastclick
	])
		.pipe(plugins.concat('jquery-plugins.js'))
		.pipe(plugins.uglify({ compress: true, keepSpecialComments: 0 }))
		.pipe(plugins.rename({ suffix: '.min' })) 
		.pipe(gulp.dest(_dest.js));
});
gulp.task('jquery:plugins:css', function() {
	return gulp.src([
		_css.foundationDatePicker,
		_css.lightbox,
		_css.nprogress,
		_css.responsiveTables
	])
		.pipe(plugins.minifyCss({ keepSpecialComments: 0 }))
		.pipe(plugins.concat('jquery-plugins.css'))
		.pipe(plugins.rename({ suffix: '.min' })) 
		.pipe(gulp.dest(_dest.css));
});

/**
 * 'app/views/**\/*.php'
 */
gulp.task('views', function() {
	return gulp.src(_app.views);
});

/**
 * Watch and Livereload of assets, views
 */
gulp.task('watch', function() {
		var livereload = plugins.livereload;
		livereload.listen();
		
		gulp.watch(_scss.foundation, 		['foundation:scss']).on('change', livereload.changed);
		gulp.watch(_scss.fontAwesome,		['fontAwesome:scss']).on('change', livereload.changed);
		// gulp.watch(_css.bootstrap,			['bootstrap:css']).on('change', livereload.changed);
		gulp.watch(_less.bootstrap,			['bootstrap:less']).on('change', livereload.changed);
		// gulp.watch(_js.foundation,		 	['foundation:js']).on('change', livereload.changed);
		// gulp.watch(_js.foundationModules, 	['foundation:js:modules']).on('change', livereload.changed);
		// gulp.watch(_js.bootstrap,			['bootstrap:js']).on('change', livereload.changed);
		// gulp.watch(_js.jquery, 				['jquery:js']).on('change', livereload.changed);
		// gulp.watch(_fonts.fontAwesome,		['fontAwesome:fonts']).on('change', livereload.changed);
		// gulp.watch(_fonts.bootstrap,		['bootstrap:fonts']).on('change', livereload.changed);
		gulp.watch(_app.views,				['views']).on('change', livereload.changed);
		gulp.watch(_app.angularApp,			['angularApp']).on('change', livereload.changed);
});

/**
 * Delete app and asset files in root public folder
 */
gulp.task('clean', function() {
	return gulp.src([
		_dest.app , 'public/assets'
	])
	.pipe(plugins.clean());
});

/**
 * angular task doesn't include the angular.min.js file
 * it's in the header:scripts task
 */
gulp.task('angular', ['angular:modules:css', 'angular:modules:js']);
gulp.task('angularApp', ['angular:app:js', 'angular:app:html']);
gulp.task('foundation', ['foundation:scss', 'foundation:js', 'foundation:modules:js']);
gulp.task('fontAwesome', ['fontAwesome:scss', 'fontAwesome:fonts']);
gulp.task('bootstrap', ['bootstrap:less', 'bootstrap:fonts', 'bootstrap:js', 'bootstrap:modules:js']);
// gulp.task('bootstrap', ['bootstrap:css', 'bootstrap:fonts', 'bootstrap:js']);
gulp.task('jquery', ['jquery:js', 'jquery:plugins:js', 'jquery:plugins:css']);
gulp.task('default', ['header:scripts', 'angular', 'angularApp', 'foundation', 'fontAwesome', 'jquery', 'views', 'bootstrap', 'watch']);