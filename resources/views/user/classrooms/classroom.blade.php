@extends('user.content')

@section('subcontent')
	<div class="panel panel-default classroom-wrapper">
		<header class="classroom-header panel-heading">
			<h1 class="panel-title text-bold">{{ $classroom->classname }}</h1>
		</header>
		<ul class="list-group">
			<li class="list-group-item">{!! $classroom->description !!}</li>
			<li class="list-group-item text-small"><strong>Guru:</strong> {{ $classroom->teacher_name }}</li>
		</ul>
		<ul class="nav nav-tabs">
			<li role="presentation" class="{{ set_active('classrooms.show') }}">
				<a href="{{ route('classrooms.show', $classroom) }}">
					Diskusi
				</a>
			</li>
			<li role="presentation" class="{{ set_active('classrooms.courses') }}">
				<a href="{{ route('classrooms.courses', $classroom) }}">
					Materi
				</a>
			</li>
			<li role="presentation" class="{{ set_active('classrooms.assignments') }}">
				<a href="{{ route('classrooms.assignments', $classroom) }}">
					Tugas
					@if($classroom->assignments->count() > 0)
						<span class="badge">{{ $classroom->assignments->count() }}</span>
					@endif
				</a>
			</li>
			<li role="presentation" class="{{ set_active('classrooms.quizes') }}">
				<a href="{{ route('classrooms.quizes', $classroom) }}">
					Quiz
					{{--@if($classroom->quizes->count() > 0)
						<span class="badge">{{ $classroom->quizes->count() }}</span>
					@endif --}}
				</a>
			</li>
			<li role="presentation" class="{{ set_active('classrooms.members') }}">
				<a href="{{ route('classrooms.members', $classroom) }}">
					Member
				</a>
			</li>
			@can('manage')
				<li role="presentation" class="pull-right"><a href="#"><i class="fa fa-cog"></i></a></li>
			@endcan
		</ul>
	</div>

	<div class="panel panel-default new">
		<header class="classroom-header panel-heading">
			<h1 class="panel-title text-bold">Bagikan ke kelas ini.</h1>
		</header>
		@include('user.classrooms._tabs')
	</div>
	@yield('classroom_content')
@endsection
