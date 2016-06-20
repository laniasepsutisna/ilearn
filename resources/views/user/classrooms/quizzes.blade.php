@extends('user.classrooms.classroom')

@section('classroom_content')
	@forelse($classroom->paginateQuizzes as $quiz)
		<div class="panel panel-default">
			<header class="panel-heading">
				<h2 class="panel-title text-bold">{{ $quiz->title }}</h2>
			</header>
			<ul class="list-group">
				<li class="list-group-item"><strong>Total</strong> {{ $quiz->multiplechoices->count() }} soal.</li>
				<li class="list-group-item"><strong>Batas waktu</strong> {{ $quiz->time_limit }} menit.</li>
			</ul>
			@cannot('manage')
			<footer class="panel-footer text-right">
				{!! Form::open(['route' => 'quizzes.start', 'id' => 'start-quiz-form']) !!}
					{!! Form::hidden('classroom_id', $classroom->id) !!}
					{!! Form::hidden('quiz_id', $quiz->id) !!}
					{!! Form::button('<i class="fa fa-check"></i> Kerjakan</a>', ['class' => 'btn btn-primary', 'id' => 'start-quiz']) !!}
				{!! Form::close() !!}
			</footer>
			@endcannot
		</div>
	@empty
		<h4 class="text-center no-content">Belum ada quiz diberikan untuk kelas ini.</h4>
	@endforelse
	{{ $classroom->paginateQuizzes->links() }}
@endsection