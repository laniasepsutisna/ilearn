<aside class="main-sidebar">
	<section class="sidebar">
		<div class="user-panel">
			<div class="pull-left image">
				<img src="{{ Auth::user()->picture }}" class="img-circle" alt="User Image" />
			</div>
			<div class="pull-left info">
				<p>{{ Auth::user()->fullname }}</p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>

		<form action="#" method="get" class="sidebar-form">
			<div class="input-group">
				<input type="text" name="q" class="form-control" placeholder="Cari..."/>
				<span class="input-group-btn">
					<button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
				</span>
			</div>
		</form>

		<ul class="sidebar-menu">
			<li class="header">MENU UTAMA</li>
			<li class="{{ set_active('auth.index') }}"><a href="{{ route('auth.index') }}"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></li>
			<li class="treeview {{ set_active(['announcements.index', 'announcements.create', 'announcements.edit', 'announcements.trash']) }}">
				<a href="#"><i class="fa fa-volume-up"></i> <span>Pengumuman</span> <i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class="{{ set_active('announcements.index') }}"><a href="{{ route('announcements.index') }}">Lihat Semua Pengumuman</a></li>
					<li class="{{ set_active('announcements.create') }}"><a href="{{ route('announcements.create') }}">Tambah Pengumuman</a></li>
				</ul>
			</li>


			<li class="header">MANAJEMEN KELAS</li>
			<li class="treeview {{ set_active(['majors.index', 'majors.create', 'majors.edit']) }}">
				<a href="#"><i class="fa fa-mortar-board"></i> <span>Jurusan</span> <i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li><a class="{{ set_active('majors.index') }}" href="{{ route('majors.index') }}">Lihat Semua Jurusan</a></li>
					<li><a class="{{ set_active('majors.create') }}" href="{{ route('majors.create') }}">Tambah Jurusan</a></li>
				</ul>
			</li>
			<li class="treeview {{ set_active(['subjects.index', 'subjects.create', 'subjects.edit']) }}">
				<a href="#"><i class="fa fa-book"></i> <span>Mata Pelajaran</span> <i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li><a class="{{ set_active('subjects.index') }}" href="{{ route('subjects.index') }}">Lihat Semua Mapel</a></li>
					<li><a class="{{ set_active('subjects.create') }}" href="{{ route('subjects.create') }}">Tambah Mapel</a></li>
				</ul>
			</li>
			<li class="treeview {{ set_active(['classrooms.index', 'classrooms.create', 'classrooms.edit']) }}">
				<a href="#"><i class="fa fa-users"></i> <span>Kelas</span> <i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li><a class="{{ set_active('classrooms.index') }}" href="{{ route('classrooms.index') }}">Lihat Semua Kelas</a></li>
					<li><a class="{{ set_active('classrooms.create') }}" href="{{ route('classrooms.create') }}">Tambah Kelas</a></li>
				</ul>
			</li>

			<li class="header">MANAJEMEN USER</li>
			<li class="treeview {{ set_active(['users.index', 'users.create', 'users.edit', 'users.trash']) }}">
				<a href="#"><i class="fa fa-user"></i> <span>User</span> <i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class="{{ set_active('users.index') }}"><a href="{{ route('users.index') }}">Lihat Semua User</a></li>
					<li class="{{ set_active('users.create') }}"><a href="{{ route('users.create') }}">Tambah User</a></li>
				</ul>
			</li>
		</ul>
	</section>
</aside>