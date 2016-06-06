@extends('user.classrooms.classroom')

@section('classroom_content')
	<div class="panel panel-default panel-module">
		<header class="panel-heading clearfix">
			<h2 class="panel-title text-bold">{{ $quiz->title }}</h2>
		</header>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-12">
					@if($quiz->type === 'multiple_choice')
					{!! Form::open(['method' => 'post', 'id' => 'multiplechoice-form']) !!}
						@foreach($quiz->multiplechoices->shuffle() as $index => $multiplechoice)
							<div class="question-detail">
								<div>{{ $index + 1 }}. {{ $multiplechoice->question }}</div>
								<div>
									<div class="col-xs-6">{!! Form::radio('answer[' . $index . ']', 'A') !!} A. {{ $multiplechoice->answer->answer_1 }}</div>
									<div class="col-xs-6">{!! Form::radio('answer[' . $index . ']', 'C') !!} C. {{ $multiplechoice->answer->answer_3 }}</div>
									<div class="col-xs-6">{!! Form::radio('answer[' . $index . ']', 'B') !!} B. {{ $multiplechoice->answer->answer_2 }}</div>
									<div class="col-xs-6">{!! Form::radio('answer[' . $index . ']', 'D') !!} D. {{ $multiplechoice->answer->answer_4 }}</div>
								</div>
							</div>
						@endforeach
						<div class="form-group"> 
							{!! Form::button('Selesai', ['class' => 'btn btn-success', 'id' => 'mc-form-detail-submit']) !!}
						</div>
					{!! Form::close() !!}
					@else

					@endif
				</div>
			</div>
		</div>
	</div>
@endsection
