var elixir = require('laravel-elixir');

/*
|--------------------------------------------------------------------------
| Elixir Asset Management
|--------------------------------------------------------------------------
|
| Elixir provides a clean, fluent API for defining some basic Gulp tasks
| for your Laravel application. By default, we are compiling the Sass
| file for our application, as well as publishing vendor resources.
|
*/

elixir(function(mix) {
	// CSS
	mix
	.styles([
	  'shared/bootstrap3-wysihtml5.min.css',
	  'shared/datepicker3.css',
	  'shared/sweetalert.css',
	  'admin/adminlte.min.css',
	  'admin/skins/skin-blue.min.css',
	  'admin/app.css'
	], 'public/assets/css/admin/build.min.css'
	)
	.styles([
	  'shared/bootstrap3-wysihtml5.min.css',
	  'shared/datepicker3.css',
	  'shared/sweetalert.css',
	  'client/app.css'
	], 'public/assets/css/client/build.min.css'
	)
	.styles('login/login.css', 'public/assets/css/client/login.min.css');

	// Javascript
	mix.scripts([
		'shared/bootstrap-datepicker.js',
		'shared/bootstrap3-wysihtml5.all.min.js',
		'shared/sweetalert.min.js',
		'admin/adminlte.app.min.js',
		'admin/app.js'
		], 'public/assets/js/admin/build.min.js')
	.scripts([
		'shared/bootstrap-datepicker.js',
		'shared/bootstrap3-wysihtml5.all.min.js',
		'shared/sweetalert.min.js',
		'client/velocity.js',
		'client/moment.js',
		'client/countdown.js',
		'client/lms-paginate.js',
		'client/app.js',
		'client/quiz.js'
	], 'public/assets/js/client/build.min.js');
});
