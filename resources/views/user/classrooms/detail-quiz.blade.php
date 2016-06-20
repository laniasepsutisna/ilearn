@extends('user.app')

@section('content')
	<div class="container" id="luar" style="padding-top: 100px;">
		<div class="row">
			<div class="col-sm-12" style=" background-color: #FFF;">
				{!! Form::open(['route' => 'quizzes.submit', 'id' => 'multiplechoice-form']) !!}
					{!! Form::hidden('classroom_id', $classroom->id) !!}
					{!! Form::hidden('quiz_id', $quiz->id) !!}
					<div id="lms-paginator">
						@foreach($quiz->multiplechoices as $index => $mc)
							<div class="question-detail">
								<div class="mc-order">{{ $index + 1 }}. </div>
								<div class="mc-wrapper">
									<h3 class="mc-question">{{ $mc->question }}</h3>
									<div class="mc-answers">
										<div class="col-xs-6">
											{!! Form::radio('answer[' . $mc->id . ']', 'A', $answer[$mc->id] === 'A' ? true : false) !!} A. {{ $mc->answer_1 }}</div>
										<div class="col-xs-6">
											{!! Form::radio('answer[' . $mc->id . ']', 'C', $answer[$mc->id] === 'C' ? true : false) !!} C. {{ $mc->answer_3 }}</div>
										<div class="col-xs-6">
											{!! Form::radio('answer[' . $mc->id . ']', 'B', $answer[$mc->id] === 'B' ? true : false) !!} B. {{ $mc->answer_2 }}</div>
										<div class="col-xs-6">
											{!! Form::radio('answer[' . $mc->id . ']', 'D', $answer[$mc->id] === 'D' ? true : false) !!} D. {{ $mc->answer_4 }}</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
					<div class="form-group"> 
						{!! Form::button('<i class="fa fa-check"></i> Selesai', ['class' => 'btn btn-success', 'id' => 'mc-form-detail-submit', 'type' => 'submit']) !!}
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection
