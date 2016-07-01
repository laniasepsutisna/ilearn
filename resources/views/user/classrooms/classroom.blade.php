@extends('user.content')

@section('subcontent')
	<div class="panel panel-default classroom-wrapper">
		<header class="classroom-header panel-heading">
			<h1 class="panel-title text-bold">{{ $classroom->classname }}</h1>
		</header>
		<ul class="list-group">
			<li class="list-group-item">
				@if(Request::route()->getName() === 'classrooms.user.edit')
					{!! Form::open(['route' => ['classrooms.user.update', $classroom], 'method' => 'post']) !!}
						{!! Form::textarea('description', $classroom->description, ['class' => 'textarea form-control']) !!}
						<div class="form-submit text-right"> 
							<a href="{{ route('classrooms.show', $classroom) }}" class="btn btn-danger">Batal</a> 
							{!! Form::submit('Ubah', ['class' => 'btn btn-primary']) !!}
						</div>
					{!! Form::close() !!}
				@else
					{!! $classroom->description !!}
				@endif
			</li>
			<li class="list-group-item text-small"><strong>Guru:</strong> {{ $classroom->teacher_name }}</li>
		</ul>
		<ul class="nav nav-tabs">
			<li role="presentation" class="{{ set_active('classrooms.show') }}">
				<a href="{{ route('classrooms.show', $classroom) }}">Diskusi</a>
			</li>
			<li role="presentation" class="{{ set_active('classrooms.courses') }}">
				<a href="{{ route('classrooms.courses', $classroom) }}">Materi</a>
			</li>
			<li role="presentation" class="{{ set_active('classrooms.assignments') }}">
				<a href="{{ route('classrooms.assignments', $classroom) }}">Tugas</a>
			</li>
			<li role="presentation" class="{{ set_active('classrooms.quizzes') }}">
				<a href="{{ route('classrooms.quizzes', $classroom) }}">Quiz</a>
			</li>
			<li role="presentation" class="{{ set_active('classrooms.members') }}">
				<a href="{{ route('classrooms.members', $classroom) }}">Member</a>
			</li>
			@can('manage')
				<li role="presentation" class="pull-right"><a href="{{ route('classrooms.user.edit', $classroom) }}"><i class="fa fa-cog"></i></a></li>
			@endcan
		</ul>
	</div>

	@if(! is_detailpage())
		<div class="panel panel-default new">
			<header class="classroom-header panel-heading">
				<h1 class="panel-title text-bold">Bagikan ke kelas ini.</h1>
			</header>
			@include('user.classrooms._tabs')
		</div>
	@endif

	@yield('classroom_content')

@endsection
