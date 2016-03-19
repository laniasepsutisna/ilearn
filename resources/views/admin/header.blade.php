<header class="main-header">
	<a href="{{ route('lms-admin.index') }}" class="logo">
		<span class="logo-mini"><b>W</b>H</span>
		<span class="logo-lg"><b>Wira</b> Harapan</span>
	</a>
	<nav class="navbar navbar-static-top" role="navigation">
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>

		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{ Auth::user()->picture }}" class="user-image" alt="User Image"/>
						<span class="hidden-xs">{{ Auth::user()->firstname }}</span>
					</a>
					<ul class="dropdown-menu">
						<li class="user-header" style="background: url({{ Auth::user()->cover }});">
							<img src="{{ Auth::user()->picture }}" class="img-circle" alt="User Image" />
							<p>
								{{ Auth::user()->fullname }}
								<small>{{ Auth::user()->created_at }}</small>
							</p>
						</li>
						<li class="user-footer">
							<div class="pull-left">
								<a href="{{ route('lms-admin.profile') }}" class="btn btn-default btn-flat">Profil</a>
							</div>
							<div class="pull-right">
								<a href="{{ route('get.logout') }}" class="btn btn-default btn-flat">Keluar</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>