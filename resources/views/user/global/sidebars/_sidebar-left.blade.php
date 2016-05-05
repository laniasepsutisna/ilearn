<aside class="sidebar left-sidebar">
	<div class="lms-sidebar-menu">
		<h5 class="heading">DASHBOARD</h5>
		<ul class="nav">
			<li class="{{ set_active('home.index') }}"><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> Timeline</a></li>
			@can('manage')
				<li class="{{ set_active(['assignments.index', 'assignments.edit']) }}"><a href="{{ route('assignments.index') }}"><i class="fa fa-file-text"></i> Tugas</a></li>
				<li class="{{ set_active(['courses.index', 'courses.edit']) }}"><a href="{{ route('courses.index') }}"><i class="fa fa-book"></i> Materi</a></li>
				<li class="{{ set_active(['quizzes.index', 'quizes.edit']) }}"><a href="{{ route('quizzes.index') }}"><i class="fa fa-question"></i> Quiz</a></li>
			@endcan
			<li><a href="{{ route('home.calendar') }}"><i class="fa fa-calendar"></i> Kalender</a></li>
		</ul>
	</div>

	<div class="classrooms">
		<h5 class="heading">KELAS</h5>
		<ul class="nav classrooms">
			@foreach($lms['classrooms'] as $classroom)
				<li class="{{ selected_classroom($classroom->id) }}"><a href="{{ route('classrooms.show', [$classroom->id]) }}">{{ $classroom->classname }}</a></li>
			@endforeach
		</ul>
	</div>
</aside>