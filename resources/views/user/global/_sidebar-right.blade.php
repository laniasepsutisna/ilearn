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
			<h2 class="panel-title">Sedang Online &middot; <small> <a href="">Lihat Semua</a></small></h2>
		</header>	
		<ul class="friends list-group">
			@forelse($lms['online'] as $online)
				<li class="list-group-item"><a href=""><i class="fa fa-circle"></i> {{ $online->fullname }}</a></li>
			@empty
				<li class="list-group-item"><small>Tidak ada user online.</small></li>
			@endforelse
		</ul>
	</div>
	
	<div class="panel panel-default tasks">
		<header class="panel-heading">	
			<h2 class="panel-title">Tugas &middot; <small> <a href="">Lihat Semua</a></small></h2>
		</header>
		<ul class="list-group">
			@foreach($lms['profile']->classrooms as $classroom)
				<li class="list-group-item text-bold">{{ $classroom->class_name }}</li>
				<li class="list-group-item">
					<ul class="list-group text-small">
						@foreach($classroom->assignments as $assignment)
							<li class="list-group-item"><a href="{{ route('assignments.show', $assignment->id) }}">{{ $assignment->title }}</a></li>
						@endforeach
					</ul>
				</li>
			@endforeach
		</ul>
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