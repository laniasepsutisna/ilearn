<!DOCTYPE html>
<!--                                     ____
										 |  |
	   _____  _  ___  ________  ______   |  |__     __   __
	 / 	___/ | ' __/ |  ___  | /  _____\ |   _  \  |  | |  |
	|  |__   |  |    | |___| | \_____  \ |  |_)  | |  |_|  |
	 \_____\ |__|    |_______| /_______/ |_'____/  _\___,  |
	  https://github.com/alfredcrosby/ilearn      |_______/
 -->
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ $page_title or 'Beranda' }} | LMS SMK WIRA HARAPAN</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ asset('/src/css/app.css') }}">

	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
</head>
<body class="students logged-in user-style-user_name">
	@if (Session::has('flash_notification.message'))
		<div class="alert alert-{{ Session::get('flash_notification.level') }} hide-auto">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			{{ Session::get('flash_notification.message') }}
		</div>
	@endif
	
	<nav class="navbar navbar-fixed-top navbar-default ilearn-main-nav">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="{{ route('home.index') }}"><strong>WH</strong> LMS</a>
			</div>

			<div class="navbar-primary">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="{{ route('announcements.index') }}"><i class="fa fa-bell"></i></a></li>		
					<li class="profile-link">
						<a href="{{ route('home.profile') }}">
							<img class="img-circle" src="{{ $lms['profile']->picture }}"> 
							{{ $lms['profile']->firstname }}</a>
						</li>		
					<li><a href="{{ route('auth.logout') }}"><i class="fa fa-sign-out"></i></a></li>
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script type="text/javascript" src="{{ asset('/client/js/app.js') }}"></script>
</body>
</html>