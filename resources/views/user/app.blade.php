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
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.7.1/fullcalendar.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800,400italic,600,600italic,700italic,800italic' rel='stylesheet' type='text/css'>
	<link href="{{ asset('assets/css/client/build.min.css') }}" rel="stylesheet" type="text/css" />

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
				<a class="navbar-brand hidden-xs" href="{{ route('home.index') }}"><strong>WH</strong> LMS</a>
				<button class="panel-button" id="open-left-panel"><i class="fa fa-bars"></i></button>
				<button class="panel-button" id="close-left-panel"><i class="fa fa-close"></i></button>
			</div>

			<div class="navbar-primary">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="{{ route('home.announcements') }}"><i class="fa fa-bell"></i></a></li>		
					<li class="profile-link">
						<a href="{{ route('home.profile') }}">
							<img class="img-circle" src="{{ $lms['profile']->picture_sm }}"> 
							{{ $lms['profile']->firstname }}</a>
						</li>		
					<li><a href="{{ route('auth.logout') }}"><i class="fa fa-power-off"></i></a></li>
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')
	
	@include('user.global.sidebars._panel')
	
  <div class="modal fade" tabindex="-1" role="dialog" id="refresh">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Oops!!</h4>
        </div>
        <div class="modal-body">
          <p>Terjadi kesalahan. Coba refresh halaman.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="refresh-page">Refresh</button>
        </div>
      </div>
    </div>
  </div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.0.1/Chart.bundle.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.7.1/fullcalendar.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
	<script src="{{ asset('assets/js/client/build.min.js') }}" type="text/javascript"></script>
	@yield('scripts')
</body>
</html>