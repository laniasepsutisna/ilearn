<!DOCTYPE html>
<!--                                     ____
                                         |  |
       _____  _  ___  ________  ______   |  |__     __   __
     / 	___/ | ' __/ |  ___  | /  _____\ |   _  \  |  | |  |
    |  |__   |  |    | |___| | \_____  \ |  |_)  | |  |_|  |
     \_____\ |__|    |_______| /_______/ |_'____/  _\___,  |
                 http://alfredcrosby.com          |_______/
 -->
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ $page_title or 'Home' }} | LMS SMK WIRA HARAPAN</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	@yield('header_scripts')
	<link href="{{ asset('/css/adminlte.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('/css/skins/skin-blue.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('/css/admin.app.css') }}" rel="stylesheet" type="text/css" />

	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
  	<div class="wrapper">
		@include('admin.header')

		@if(Auth::user()->hasRole('staff'))
	  		@include('admin.sidebars.staff')
	  	@elseif(Auth::user()->hasRole('teacher'))
	  		@include('admin.sidebars.teacher')
	  	@elseif(Auth::user()->hasRole('student'))
	  		@include('admin.sidebars.student')
  		@endif

		<div class="content-wrapper">
			<section class="content-header">
				<h1>{{ $page_title or 'Home' }} <small> @yield('page_description')</small></h1>

				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
					<li class="active">Here</li>
				</ol>
			</section>

			<section class="content">
				@if (Session::has('flash_notification.message'))
		            <div class="alert alert-{{ Session::get('flash_notification.level') }}">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                {{ Session::get('flash_notification.message') }}
		            </div>
			    @endif
			    
				@yield('content')
			</section>
		</div>

		@include('admin.footer')
	</div><!-- ./wrapper -->

	<script src="{{ asset ('/js/libs/jquery.min.js') }}"></script>
	<script src="{{ asset ('/js/libs/bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset ('/js/libs/adminlte.app.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset ('/js/libs/sweetalert.min.js') }}" type="text/javascript"></script>
	@yield('footer_scripts')
</body>
</html>