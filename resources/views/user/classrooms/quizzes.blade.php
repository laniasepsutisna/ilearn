@extends('user.classrooms.classroom')

@section('classroom_content')
	@forelse($quizzes as $quiz)
		<div class="panel panel-default">
			<header class="panel-heading">
				<h2 class="panel-title text-bold">{{ $quiz->title }}</h2>
			</header>
			<ul class="list-group">
				<li class="list-group-item"><strong>Total</strong> {{ $quiz->multiplechoices->count() }} soal.</li>
				<li class="list-group-item"><strong>Batas waktu</strong> {{ $quiz->time_limit }} menit.</li>
				<li class="list-group-item"><strong>Nilai minimum yang harus dicapai</strong> {{ $quiz->pass_score }}</li>
			</ul>
			@can('manage')
				<footer class="panel-footer text-right">
					<a class="btn btn-primary" href="{{ route('classrooms.score', [$classroom->id, $quiz->id]) }}"><i class="fa fa-eye"></i>  Lihat Nilai</a>
				</footer>
			@else
				<footer class="panel-footer text-right">
				@if($quiz->students->contains($lms['profile']->id))

					@if($quiz->students()->where('id', $lms['profile']->id)->first()->pivot->status == 'ongoing')
						<a href="{{ route('classrooms.quizdetail', [$classroom->id, $quiz->id]) }}" class="btn btn-primary"><i class="fa fa-check"></i> Lanjut mengerjakan</a>
					@else
						<p class="text-right text-success"><strong>Quiz sudah dikerjakan.</strong></p>
					@endif

				@else				
					{!! Form::button('<i class="fa fa-check"></i> Kerjakan</a>', ['class' => 'btn btn-primary', 'id' => 'start-quiz', 'data-classroom_id' => $classroom->id, 'data-quiz_id' => $quiz->id]) !!}
				@endif
				</footer>
			@endcan
		</div>
	@empty
		<h4 class="text-center no-content">Belum ada quiz diberikan untuk kelas ini.</h4>
	@endforelse
	{{ $quizzes->links() }}
@endsection