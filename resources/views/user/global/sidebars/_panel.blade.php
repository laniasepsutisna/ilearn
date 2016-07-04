<aside class="panel-left hidden-md hidden-lg">
	<div class="panel-left-heading clearfix">
		<h3><a class="navbar-brand" href="{{ route('home.index') }}"><strong>W</strong>ira <strong>H</strong>arapan LMS</a></h3>
	</div>
	<ul class="panel-menu clearfix">
		<li class="panel-menu-heading">DASHBOARD</li>
		<li class="{{ set_active('home.index') }}"><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> Timeline</a></li>
		@can('manage')
			<li class="{{ set_active(['courses.index', 'courses.edit']) }}"><a href="{{ route('courses.index') }}"><i class="fa fa-book"></i> Materi</a></li>
			<li class="{{ set_active(['assignments.index', 'assignments.edit']) }}"><a href="{{ route('assignments.index') }}"><i class="fa fa-file-text"></i> Tugas</a></li>
			<li class="{{ set_active(['quizzes.index', 'quizes.edit']) }}"><a href="{{ route('quizzes.index') }}"><i class="fa fa-question"></i> Quiz</a></li>
		@endcan
		<li><a href="{{ route('home.calendar') }}"><i class="fa fa-calendar"></i> Kalender</a></li>
		<li class="panel-menu-heading">KELAS</li>
		@foreach($lms['classrooms'] as $classroom)
			<li class="panel-left-classrooms {{ selected_classroom($classroom->id) }}"><a href="{{ route('classrooms.show', [$classroom->id]) }}">{{ $classroom->classname }}</a></li>
		@endforeach
		<li class="panel-menu-heading">TUGAS</li>
		@forelse($lms['assignments'] as $assignment)
			@can('manage')
				<li class="panel-left-assignments">
					<strong>{{ $assignment->title }}</strong>
					@foreach($assignment->classrooms as $classroom)
						<a href="{{ route('classrooms.assignmentdetail', [$classroom->id, $assignment->id]) }}">
							<i class="fa fa-eye"></i>
							<span>{{ $classroom->classname }}</span>
						</a>
					@endforeach
				</li>
			@else
				<li class="panel-left-assignments">
					<a href="{{ route('classrooms.assignmentdetail', [$assignment->classrooms->whereIn('id', $lms['profile']->joinedClassrooms)->first()->id, $assignment->id]) }}">
						<i class="fa fa-file"></i>
						<span>{{ $assignment->title }}</span>
					</a>
				</li>
			@endcan
		@empty
			<li class="panel-left-assignments"><a href="#">Yay, tidak ada tugas.</a></li>
		@endforelse
		<li class="panel-menu-heading">ONLINE</li>			
		@forelse($lms['online'] as $online)
			<li class="panel-left-online"><a href="{{ route('home.friend', $online->username) }}"><i class="fa fa-circle" style="color: green;"></i> {{ $online->fullname }}</a></li>
		@empty
			<li class="panel-left-online"><a href="#">Tidak ada user online.</a></li>
		@endforelse
	</ul>
</aside>
<div id="left-panel-overlay"></div>