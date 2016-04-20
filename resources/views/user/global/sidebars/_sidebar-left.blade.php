<aside class="sidebar left-sidebar">
	<div class="lms-sidebar-menu">
		<h5 class="heading">DASHBOARD</h5>
		<ul class="nav">
			<li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> Timeline</a></li>
			@can('manage')
				<li><a href="{{ route('assignments.index') }}"><i class="fa fa-file-text"></i> Perpustakaan</a></li>
			@endcan
			<li><a href="{{ route('home.calendar') }}"><i class="fa fa-calendar"></i> Kalender</a></li>
		</ul>
	</div>

	<div class="classrooms">
		<h5 class="heading">KELAS</h5>
		<ul class="nav">
			@foreach($lms['classrooms'] as $classroom)
				<li><a href="{{ route('classrooms.show', [$classroom->id]) }}"><i class="fa fa-institution"></i> {{ $classroom->classname }}</a></li>
			@endforeach
		</ul>
	</div>
</aside>