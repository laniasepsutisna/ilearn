@extends('user.classrooms.classroom')

@section('classroom_content')
	@forelse($classroom->paginateQuizzes as $quiz)
		<div class="panel panel-default">
			<header class="panel-heading">
				<h2 class="panel-title text-bold">{{ $quiz->title }}</h2>
			</header>
			<ul class="list-group">
				<li class="list-group-item"><strong>Tipe: </strong> {{ $quiz->humanizeType }}</li>
				<li class="list-group-item"><strong>Waktu: </strong> {{ $quiz->time_limit }} menit.</li>
			</ul>
			@cannot('manage')
			<footer class="panel-footer text-right">
				<a href="{{ route('classrooms.quizdetail', [$classroom->id, $quiz->id]) }}" class="btn btn-primary">Kerjakan</a>
			</footer>
			@endcannot
		</div>
	@empty
		<h4 class="text-center no-content">Belum ada quiz diberikan untuk kelas ini.</h4>
	@endforelse
	{{ $classroom->paginateQuizzes->links() }}
@endsection