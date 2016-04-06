<aside class="main-sidebar">
	<section class="sidebar">
		<div class="user-panel">
			<div class="pull-left image">
				<img src="{{ Auth::user()->picture_sm }}" class="img-circle" alt="User Image" />
			</div>
			<div class="pull-left info">
				<p>{{ Auth::user()->fullname }}</p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>

		<ul class="sidebar-menu">
			<li class="header">MENU UTAMA</li>
			<li class="{{ set_active('lms-admin.index') }}"><a href="{{ route('lms-admin.index') }}"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></li>
			<li class="treeview {{ set_active(['lms-admin.announcements.index', 'lms-admin.announcements.create', 'lms-admin.announcements.edit', 'lms-admin.announcements.trash']) }}">
				<a href="#"><i class="fa fa-volume-up"></i> <span>Pengumuman</span> <i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class="{{ set_active('lms-admin.announcements.index') }}"><a href="{{ route('lms-admin.announcements.index') }}">Lihat Semua Pengumuman</a></li>
					<li class="{{ set_active('lms-admin.announcements.create') }}"><a href="{{ route('lms-admin.announcements.create') }}">Tambah Pengumuman</a></li>
				</ul>
			</li>


			<li class="header">MANAJEMEN KELAS</li>
			<li class="treeview {{ set_active(['lms-admin.majors.index', 'lms-admin.majors.create', 'lms-admin.majors.edit']) }}">
				<a href="#"><i class="fa fa-mortar-board"></i> <span>Jurusan</span> <i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li><a class="{{ set_active('lms-admin.majors.index') }}" href="{{ route('lms-admin.majors.index') }}">Lihat Semua Jurusan</a></li>
					<li><a class="{{ set_active('lms-admin.majors.create') }}" href="{{ route('lms-admin.majors.create') }}">Tambah Jurusan</a></li>
				</ul>
			</li>
			<li class="treeview {{ set_active(['lms-admin.subjects.index', 'lms-admin.subjects.create', 'lms-admin.subjects.edit']) }}">
				<a href="#"><i class="fa fa-book"></i> <span>Mata Pelajaran</span> <i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li><a class="{{ set_active('lms-admin.subjects.index') }}" href="{{ route('lms-admin.subjects.index') }}">Lihat Semua Mapel</a></li>
					<li><a class="{{ set_active('lms-admin.subjects.create') }}" href="{{ route('lms-admin.subjects.create') }}">Tambah Mapel</a></li>
				</ul>
			</li>
			<li class="treeview {{ set_active(['lms-admin.classrooms.index', 'lms-admin.classrooms.create', 'lms-admin.classrooms.edit']) }}">
				<a href="#"><i class="fa fa-users"></i> <span>Kelas</span> <i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li><a class="{{ set_active('lms-admin.classrooms.index') }}" href="{{ route('lms-admin.classrooms.index') }}">Lihat Semua Kelas</a></li>
					<li><a class="{{ set_active('lms-admin.classrooms.create') }}" href="{{ route('lms-admin.classrooms.create') }}">Tambah Kelas</a></li>
				</ul>
			</li>

			<li class="header">MANAJEMEN USER</li>
			<li class="treeview {{ set_active(['lms-admin.users.index', 'lms-admin.users.create', 'lms-admin.users.edit', 'lms-admin.users.trash']) }}">
				<a href="#"><i class="fa fa-user"></i> <span>User</span> <i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li class="{{ set_active('lms-admin.users.index') }}"><a href="{{ route('lms-admin.users.index') }}">Lihat Semua User</a></li>
					<li class="{{ set_active('lms-admin.users.create') }}"><a href="{{ route('lms-admin.users.create') }}">Tambah User</a></li>
				</ul>
			</li>
		</ul>
	</section>
</aside>