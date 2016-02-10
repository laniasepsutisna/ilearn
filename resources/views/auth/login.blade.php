<!DOCTYPE html>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | E-learning SMK Wira Harapan</title>
	{{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700, 900" rel="stylesheet" type="text/css"> --}}
	<link href="{{ asset( '/css/font-awesome.min.css' ) }}" rel="stylesheet">
	<link href="{{ asset( '/css/bootstrap.min.css' ) }}" rel="stylesheet">
	<link href="{{ asset( '/css/app.css' ) }}" rel="stylesheet">
	<script type="text/javascript" src="{{ asset( '/js/libs/jquery.min.js' ) }}"></script>
</head>
<body class="login-page">

	<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="LoginModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="loginModalLabel">Login ke E-Learning</h4>
				</div>

				<div class="modal-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-3 control-label">Username</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                                
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Password</label>

                            <div class="col-md-8">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-3">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Ingatkan saya
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-3">
                                <button id="loginButton" class="btn btn-primary">                                
                                    <span class="login-loader hide"><i class="fa fa-spin fa-circle-o-notch"></i></span>
                                    <span class="sign-in"><i class="fa fa-btn fa-sign-in"></i></span>
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Lupa Password?</a>
                            </div>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>

	<div class="site">
		<div class="login-navigation">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="logo">
							<a href="{{ url('/') }}"><img src="{{ asset( '/uploads/smkwiratransparentlogo.png' ) }}"></a>
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

	<script type="text/javascript" src="{{ asset( '/js/libs/bootstrap.min.js' ) }}"></script>
	<script type="text/javascript">
	var base_url = "{{{ url('/') }}}";
	</script>
</body>
</html>
