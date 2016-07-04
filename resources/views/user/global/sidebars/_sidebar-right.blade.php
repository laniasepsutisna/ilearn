<aside class="sidebar right-sidebar">
	<div class="thumbnail profile-panel hidden-xs hidden-sm">
		<img src="{{ $lms['profile']->cover_sm }}">
		<div class="caption">
			<a href="{{ route('home.profile') }}" class="profile-pict"><img class="img-circle" src="{{ $lms['profile']->picture_md }}"></a>
			<h2 class="fullname">{{ $lms['profile']->fullname }}</h2>
			<p class="biography text-small text-italic"><em>"{{ $lms['profile']->bio ? $lms['profile']->bio : 'Bagaimana kabarmu?' }}"</em></p>
		</div>
	</div>

	<div class="panel panel-default online">
		<header class="panel-heading">
			<h2 class="panel-title">Sedang Online</h2>
		</header>
		<ul class="friends list-group">
			@forelse($lms['online'] as $online)
				<li class="list-group-item text-small"><a href="{{ route('home.friend', $online->username) }}"><i class="fa fa-circle" style="color: green;"></i> {{ $online->fullname }}</a></li>
			@empty
				<li class="list-group-item text-small">Tidak ada user online.</li>
			@endforelse
		</ul>
		<footer class="panel-footer text-center">
			<a href="{{ route('home.onlines') }}" class="btn btn-link btn-sm">Lihat semua</a>
		</footer>
	</div>

	<div class="panel panel-default sidebar-assignments">
		<header class="panel-heading">
			<h2 class="panel-title">Tugas</h2>
		</header>
		<ul class="list-group">
			@forelse($lms['assignments'] as $assignment)
				@can('manage')
					<li class="list-group-item text-small">
						{{ $assignment->title }}
						<div>
							@foreach($assignment->classrooms as $classroom)
								<a class="btn btn-link btn-sm" href="{{ route('classrooms.assignmentdetail', [$classroom->id, $assignment->id]) }}">
									<i class="fa fa-eye"></i>
									{{ $classroom->classname }}
								</a>
							@endforeach
						</div>
					</li>
				@else
					<li class="list-group-item text-small">
						<a class="btn-link" href="{{ route('classrooms.assignmentdetail', [$assignment->classrooms->whereIn('id', $lms['profile']->joinedClassrooms)->first()->id, $assignment->id]) }}">
							<i class="fa fa-file"></i> {{ $assignment->title }}
						</a>
					</li>
				@endcan
			@empty
				<li class="list-group-item text-small">Yay, tidak ada tugas.</li>
			@endforelse
		</ul>
		<footer class="panel-footer text-center">
			<a href="{{ route('home.assignments') }}" class="btn btn-link btn-sm">Lihat semua</a>
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
