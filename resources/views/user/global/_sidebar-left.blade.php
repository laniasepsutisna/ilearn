<aside class="sidebar left-sidebar">
	<div class="lms-sidebar-menu">
		<h5 class="heading">DASHBOARD</h5>
		<ul class="nav">
			<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Timeline</a></li>
			<li><a href="{{ url('/files') }}"><i class="fa fa-file-text"></i> File</a></li>
			<li><a href="{{ url('/calendar') }}"><i class="fa fa-calendar"></i> Kalender</a></li>
		</ul>
	</div>

	<div class="classrooms">
		<h5 class="heading">KELAS</h5>
		<ul class="nav">
			@can('manage')
				@foreach($lms['profile']->teacherclassroom as $classroom)
					<li><a href="{{ route('classrooms.show', [$classroom->id]) }}"><i class="fa fa-institution"></i> {{ $classroom->classname }}</a></li>
				@endforeach
			@else
				@foreach($lms['classrooms'] as $classroom)
					<li><a href="{{ route('classrooms.show', [$classroom->id]) }}"><i class="fa fa-institution"></i> {{ $classroom->classname }}</a></li>
				@endforeach
			@endcan
		</ul>
	</div>
</aside>