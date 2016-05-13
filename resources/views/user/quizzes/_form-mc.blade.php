<div id="questions-container">
	<div class="questions-wrapper row clearfix" id="question-1">
		<div class="col-xs-1 text-center">
			<strong class="count-question btn btn-primary">1</strong>
			<div style="margin: 10px 0"><button class="remove-question btn btn-danger btn-sm" disabled="true"><i class="fa fa-close"></i></button></div>
		</div>
		<div class="col-xs-11">
			{!! Form::hidden('quiz_id', $quiz->id) !!}
			<div class="form-group {{ $errors->has('question') ? 'has-error' : '' }}">
				{!! Form::label('question', 'Pertanyaan', ['class' => 'control-label']) !!}
				{!! Form::textarea('question', null, ['class' => 'form-control', 'id' => 'question', 'placeholder' => 'Pertanyaan...', 'rows' => '5']) !!}
				{!! $errors->first('question', '<p class="help-block">:message</p>') !!}
			</div>

			<div class="row">
				<div class="form-group col-xs-6 {{ $errors->has('answer_1') ? 'has-error' : '' }}">
					{!! Form::label('answer_1', 'A', ['class' => 'control-label']) !!}
					{!! Form::text('answer_1', null, ['class' => 'form-control', 'id' => 'answer_1']) !!}
					{!! $errors->first('answer_1', '<p class="help-block">:message</p>') !!}
				</div>

				<div class="form-group col-xs-6 {{ $errors->has('answer_2') ? 'has-error' : '' }}">
					{!! Form::label('answer_2', 'B', ['class' => 'control-label']) !!}
					{!! Form::text('answer_2', null, ['class' => 'form-control', 'id' => 'answer_2']) !!}
					{!! $errors->first('answer_2', '<p class="help-block">:message</p>') !!}
				</div>

				<div class="form-group col-xs-6 {{ $errors->has('answer_3') ? 'has-error' : '' }}">
					{!! Form::label('answer_3', 'C', ['class' => 'control-label']) !!}
					{!! Form::text('answer_3', null, ['class' => 'form-control', 'id' => 'answer_3']) !!}
					{!! $errors->first('answer_3', '<p class="help-block">:message</p>') !!}
				</div>

				<div class="form-group col-xs-6 {{ $errors->has('answer_4') ? 'has-error' : '' }}">
					{!! Form::label('answer_4', 'D', ['class' => 'control-label']) !!}
					{!! Form::text('answer_4', null, ['class' => 'form-control', 'id' => 'answer_4']) !!}
					{!! $errors->first('answer_4', '<p class="help-block">:message</p>') !!}
				</div>
			</div>
		</div>
	</div>
</div>
<div class="text-center col-md-offset-1 form-submit"><button class="btn btn-lg btn-block" id="add-question"><i class="fa fa-plus"></i></button></div>