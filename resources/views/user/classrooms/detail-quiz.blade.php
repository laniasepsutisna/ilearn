@extends('user.app')

@section('content')
  <div class="container" id="luar" style="padding-top: 100px;">
    <div class="row">
      <div class="col-sm-6">
        <p class="quiz-student"><strong>Nama: </strong>{{ $lms['profile']->fullname }}</p>
        <p class="quiz-classroom"><strong>Kelas: </strong>{{ $classroom->classname }}</p>
      </div>
      <div class="col-sm-6">
        <div class="text-right">
          <button class="btn btn-warning timer" data-endtime="{{ $user->pivot->time }}">89:55</button>
          {!! Form::button('<i class="fa fa-check"></i> Selesai</a>', ['class' => 'btn btn-primary', 'id' => 'mc-form-detail-submit', 'data-classroom_id' => $classroom->id, 'data-quiz_id' => $quiz->id]) !!}
        </div>
      </div>
      <div class="col-sm-12">
          <div id="lms-paginator">
            @foreach($quiz->multiplechoices->shuffle() as $index => $mc)
              <div class="question-detail">
                <div class="mc-order">{{ $index + 1 }}. </div>
                <div class="mc-wrapper">
                  <h3 class="mc-question">{{ $mc->question }}</h3>
                  <form class="answers">
                    @if(count($answer) > 0 && array_key_exists($mc->id, $answer))
                      <div class="mc-answers">
                        <div class="col-xs-6"> 
                          {!! Form::radio('answers[' . $mc->id . ']', 'A', $answer[$mc->id] === 'A' ? true : false) !!} A. {{ $mc->answer_1 }}</div>
                        <div class="col-xs-6">
                          {!! Form::radio('answers[' . $mc->id . ']', 'C', $answer[$mc->id] === 'C' ? true : false) !!} C. {{ $mc->answer_3 }}</div>
                        <div class="col-xs-6">
                          {!! Form::radio('answers[' . $mc->id . ']', 'B', $answer[$mc->id] === 'B' ? true : false) !!} B. {{ $mc->answer_2 }}</div>
                        <div class="col-xs-6">
                          {!! Form::radio('answers[' . $mc->id . ']', 'D', $answer[$mc->id] === 'D' ? true : false) !!} D. {{ $mc->answer_4 }}</div>
                      </div>
                    @else
                      <div class="mc-answers">
                        <div class="col-xs-6"> 
                          {!! Form::radio('answers[' . $mc->id . ']', 'A') !!} A. {{ $mc->answer_1 }}</div>
                        <div class="col-xs-6">
                          {!! Form::radio('answers[' . $mc->id . ']', 'C') !!} C. {{ $mc->answer_3 }}</div>
                        <div class="col-xs-6">
                          {!! Form::radio('answers[' . $mc->id . ']', 'B') !!} B. {{ $mc->answer_2 }}</div>
                        <div class="col-xs-6">
                          {!! Form::radio('answers[' . $mc->id . ']', 'D') !!} D. {{ $mc->answer_4 }}</div>
                      </div>
                    @endif
                  </form>
                </div>
              </div>
            @endforeach
          </div>
      </div>
    </div>
  </div>
  <div class="quiz-loading"><i class="fa fa-circle-o-notch fa-spin"></i> Loading...</div>

  <div class="modal fade" tabindex="-1" role="dialog" id="refresh">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Oops!!</h4>
        </div>
        <div class="modal-body">
          <p>Terjadi kesalahan. Coba refresh halaman.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="refresh-quiz">Refresh</button>
        </div>
      </div>
    </div>
  </div>
@endsection
