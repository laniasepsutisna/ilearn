<aside class="sidebar right-sidebar">
	<div class="thumbnail profile-panel">
		<img src="{{ $lms['profile']->cover_sm }}">		
		<div class="caption">
			<a href="{{ route('home.profile') }}" class="profile-pict"><img class="img-circle" src="{{ $lms['profile']->picture_md }}"></a>
			<h2 class="fullname">{{ $lms['profile']->fullname }}</h2>
			<p class="biography">{{ $lms['profile']->email }}</p>
			<p class="biography">{{ $lms['profile']->address }}</p>
		</div>
	</div>
	
	<div class="panel panel-default online">
		<header class="panel-heading">	
			<h2 class="panel-title">Sedang Online</h2>
		</header>	
		<ul class="friends list-group">
			@forelse($lms['online'] as $online)
				<li class="list-group-item"><a href=""><i class="fa fa-circle"></i> {{ $online->fullname }}</a></li>
			@empty
				<li class="list-group-item text-small">Tidak ada user online.</li>
			@endforelse
		</ul>
		<footer class="panel-footer text-center">
			<a href="" class="btn btn-link btn-sm">Lihat semua</a>
		</footer>
	</div>
	
	<div class="panel panel-default tasks">
		<header class="panel-heading">	
			<h2 class="panel-title">Tugas</h2>
		</header>
		<ul class="list-group">
			@forelse($lms['assignments'] as $assignment)
				<li class="list-group-item"><a href="{{ route('classrooms.assignmentdetail', [$assignment->pivot->classroom_id, $assignment->id]) }}">{{ $assignment->title }}</a></li>
			@empty
				<li class="list-group-item text-small">Yay, tidak ada tugas.</li>
			@endforelse
		</ul>
		<footer class="panel-footer text-center">
			<a href="" class="btn btn-link btn-sm">Lihat semua</a>
		</footer>
	</div>

	<div class="panel panel-default footer">
		<div class="panel-body">
			<p>&copy; 2015 iLearn.
				<a href="https://github.com/alfredcrosby/ilearn">Tentang</a> &middot; 
				<a href="https://github.com/alfredcrosby/ilearn/wiki">Bantuan</a> &middot; 
				<a href="https://github.com/alfredcrosby/ilearn/wiki">Dokumentasi</a> &middot; 
				<a href="https://github.com/alfredcrosby/ilearn/graphs/contributors">Kontribusi</a> &middot; 
			</p>
		</div>
	</div>
</aside>