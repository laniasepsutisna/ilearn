<!DOCTYPE html>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $page_title }} | E-learning SMK Wira Harapan</title>
	{{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700, 900" rel="stylesheet" type="text/css"> --}}
	<link href="{{ asset( '/css/font-awesome.min.css' ) }}" rel="stylesheet">
	<link href="{{ asset( '/css/bootstrap.min.css' ) }}" rel="stylesheet">
	<link href="{{ asset( '/css/app.css' ) }}" rel="stylesheet">
	<script type="text/javascript" src="{{ asset( '/js/libs/jquery.min.js' ) }}"></script>
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

	<script type="text/javascript" src="{{ asset( '/js/libs/bootstrap.min.js' ) }}"></script>
	<script type="text/javascript">
		var base_url = "{{{ url('/') }}}";
		jQuery('.modal').on('shown.bs.modal', function() {
			jQuery(this).find('[autofocus]').focus();
		});
	</script>
</body>
</html>
