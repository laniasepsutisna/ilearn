@extends('user.classrooms.classroom')

@section('classroom_content')
	@forelse($classroom->courses as $course)
		<div class="panel panel-default">
			<header class="panel-heading">
				<h2 class="panel-title text-bold">{{ $course->name }}</h2>
			</header>
			<ul class="list-group">
				<li class="list-group-item">{!! $course->description !!}</li>
			</ul>
			<div class="panel-footer text-right">
				<a href="{{ route('classrooms.coursedetail', [$classroom->id, $course->id]) }}" class="btn btn-primary">@can('manage') Detail @else Pelajari @endcan</a>
			</div>
		</div>
	@empty
		<h4 class="text-center no-content">Belum ada materi diberikan untuk kelas ini.</h4>
	@endforelse
@endsection