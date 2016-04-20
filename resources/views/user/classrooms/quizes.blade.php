@extends('user.classrooms.classroom')

@section('classroom_content')
	{{--@forelse($classroom->paginate_course as $course)
		<div class="panel panel-default">
			<header class="panel-heading">
				<h2 class="panel-title">{{ $course->title }}</h2>
			</header>
			<ul class="list-group">
				<li class="list-group-item">{{ $course->content }}</li>
				
				<li class="list-group-item"><span class="text-small"><strong>Deadline:</strong> {{ $course->deadline }}</span></li>
			</ul>
			@if($course->file)
				<div class="panel-footer">
					<span class="attached"><i class="fa fa-paperclip"></i></span><a href="{{ route('classrooms.download', $course->file) }}">{{ $course->file }}</a>
				</div>
			@endif
		</div>
	@empty --}}
		<h4 class="text-center no-content">Belum ada quiz diberikan untuk kelas ini.</h4>
	{{-- @endforelse --}}
@endsection