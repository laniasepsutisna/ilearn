<!DOCTYPE html>
<!--                                     ____
                                         |  |
       _____  _  ___  ________  ______   |  |__     __   __
     / 	___/ | ' __/ |  ___  | /  _____\ |   _  \  |  | |  |
    |  |__   |  |    | |___| | \_____  \ |  |_)  | |  |_|  |
     \_____\ |__|    |_______| /_______/ |_'____/  _\___,  |
      https://github.com/alfredcrosby/ilearn      |_______/
 -->
<html class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $page_title }} | E-learning SMK Wira Harapan</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700, 900" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link href="{{ asset('client/css/login.css') }}" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
</head>
<body class="login-page">
	<div class="site">
		<div class="login-navigation">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="logo">
							<a href="{{ route('login') }}"><img src="{{ asset( '/uploads/smkwiratransparentlogo.png' ) }}"></a>
						</div>
						<nav class="login-menu">
							<ul>
								<li class="visible-xs-inline-block"><a href="{{ url( '/pengumuman' ) }}" title="Pengumuman"><i class="fa fa-bell"></i></a></li>
								<li class="hidden-xs"><a href="{{ url( '/pengumuman' ) }}" title="Pengumuman">Pengumuman</a></li>
								<li><button class="btn btn-success" data-toggle="modal" data-target="#loginModal">Login</button></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="welcome-text">
			<h1 class="heading text-uppercase">E-learning <br /> SMK Wira Harapan</h1>
			<p>
				Sistem pembelajaran online milik SMK Wira Harapan. <br />
				Jika anda mendapatkan masalah ketika login silakan hubungi bagian tata usaha.
			</p>
		</div>

		<div class="copyright">&copy; SMK Wira Harapan 2016.</div>
	</div>

	@yield('content')

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script type="text/javascript">
		(function($){
			$('.modal').modal({ show: true });
		})(jQuery);
	</script>
</body>
</html>
