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
	<link rel="stylesheet" href="{{ asset( '/css/app.css' ) }}">

	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
</head>
<body class="students logged-in user-style-user_name">
	
	<nav class="navbar navbar-fixed-top ilearn-main-nav">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-on-mobile">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">Wira Harapan</a>
					</div>
					
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="navbar-collapse-on-mobile">

						<ul class="nav navbar-nav">
							<li>
								<form method="get">
									<input type="search" class="form-control master-search" name="s" placeholder="Ketik lalu tekan Enter untuk mencari...">
								</form>
							</li>
						</ul>

						<ul class="nav navbar-nav navbar-right">						
							<li><a href=""><i class="fa fa-home"></i> Beranda</a></li>
							<li><a href=""><i class="fa fa-group"></i> Kelas</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-envelope"></i></a>
								<ul class="dropdown-menu" role="menu">
									<li>
										<a href="/">
											<strong>Bu Pena</strong> mengirimi anda sebuah pesan.
										</a>
									</li>
									<li role="separator" class="divider"></li>
									<li><a href="#" class="text-center">Lihat semua pesan</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-bell"></i></a>
								<ul class="dropdown-menu" role="menu">
									<li>
										<a href="/">
											<strong>Pak Adi</strong> memberi anda lencana <strong>OSIS</strong>.
										</a>
									</li>
									<li>
										<a href="/">
											<strong>Pak Christ</strong> memberi anda lencana <strong>OSIS</strong>.
										</a>
									</li>
									<li>
										<a href="/">
											<strong>Pak Darmawan</strong> memberi anda lencana <strong>OSIS</strong>.
										</a>
									</li>
									<li role="separator" class="divider"></li>
									<li><a href="#" class="text-center">Lihat semua pemberitahuan</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-gear"></i> <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li>
										<a href="/">
											<h4>Timoti Adri</h4>
											<p>Lihat Profil</p>
										</a>
									</li>
									<li role="separator" class="divider"></li>
									<li><a href="/">Bantuan</a></li>
									<li><a href="/">Privasi</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="/">Pengaturan</a></li>
									<li><a href="/logout">Logout</a></li>
								</ul>
							</li>
						</ul>

					</div><!-- /.navbar-collapse -->
				</div>
			</div>
		</div>
	</nav>

	<div class="container content">
		<div class="row">
			<div class="ilearn-alert col-md-12">
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Warning!</strong> Better check yourself, you're not looking too good.
				</div>
			</div>
			<div class="col-sm-4 col-md-3">

				@include( 'user.students.left-sidebar' )

			</div>

			<div class="col-sm-8 col-md-6">

				@include('user.students.content')

			</div>

			<div class="col-sm-8 custom-sm-offset-4 col-md-3">

				@include( 'user.students.right-sidebar' )

			</div>
		</div>
	</div>

   <script src="{{ asset( '/js/libs/jquery.min.js' ) }}"></script>
   <script src="{{ asset( '/js/libs/bootstrap.min.js' ) }}"></script>
 
   @yield('scripts')

</body>
</html>