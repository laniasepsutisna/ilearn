@extends('user.classrooms.classroom')

@section('classroom_content')
	@forelse($classroom->paginateAvailableAssignments as $assignment)
		<div class="panel panel-default">
			<header class="panel-heading">
				<h2 class="panel-title">{{ $assignment->title }}</h2>
			</header>
			<ul class="list-group">
				<li class="list-group-item">{!! $assignment->content !!}</li>

				<li class="list-group-item"><span class="text-small"><strong>Deadline:</strong> {{ formatDate($assignment->pivot->deadline) }}</span></li>
				@if($assignment->file)
					<li class="list-group-item"><span class="attached"><i class="fa fa-paperclip"></i></span><a href="{{ route('classrooms.download', $assignment->file) }}">{{ $assignment->file }}</a></li>
				@endif
			</ul>
			<div class="panel-footer text-right">
				<a href="{{ route('classrooms.assignmentdetail', [$classroom->id, $assignment->id]) }}" class="btn btn-primary">@can('manage') Detail @else Kerjakan @endcan</a>
			</div>
		</div>
	@empty
		<h4 class="text-center no-content">Belum ada tugas diberikan untuk kelas ini.</h4>
	@endforelse
	{{ $classroom->paginateAvailableAssignments->links() }}
@endsection
