<div id="question-container">
	<div class="question-wrapper row clearfix">
		<div class="col-xs-12">
			<div class="form-group {{ $errors->has('question') ? 'has-error' : '' }}">
				{!! Form::label('question', 'Pertanyaan', ['class' => 'control-label']) !!}
				{!! Form::textarea('question', null, ['class' => 'form-control', 'id' => 'question', 'placeholder' => 'Pertanyaan...', 'rows' => '5']) !!}
				{!! $errors->first('question', '<p class="help-block">:message</p>') !!}
			</div>

			<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
				{!! Form::label('image', 'Gambar', ['class' => 'control-label']) !!}
				{!! Form::file('image', ['class' => 'form-control', 'id' => 'image']) !!}
				{!! $errors->first('image', '<p class="help-block">:message</p>') !!}
			</div>
	
			<div class="row">
				<div class="form-group col-xs-12">
					<strong>Jawaban:</strong>
				</div>
				<div class="form-group col-xs-6 {{ $errors->has('answer_1') ? 'has-error' : '' }}">
					{!! Form::label('answer_1', 'A', ['class' => 'control-label']) !!}
					{!! Form::text('answer_1', null, ['class' => 'form-control']) !!}
					{!! $errors->first('answer_1', '<p class="help-block">:message</p>') !!}
				</div>

				<div class="form-group col-xs-6 {{ $errors->has('answer_2') ? 'has-error' : '' }}">
					{!! Form::label('answer_2', 'B', ['class' => 'control-label']) !!}
					{!! Form::text('answer_2', null, ['class' => 'form-control']) !!}
					{!! $errors->first('answer_2', '<p class="help-block">:message</p>') !!}
				</div>

				<div class="form-group col-xs-6 {{ $errors->has('answer_3') ? 'has-error' : '' }}">
					{!! Form::label('answer_3', 'C', ['class' => 'control-label']) !!}
					{!! Form::text('answer_3', null, ['class' => 'form-control']) !!}
					{!! $errors->first('answer_3', '<p class="help-block">:message</p>') !!}
				</div>

				<div class="form-group col-xs-6 {{ $errors->has('answer_4') ? 'has-error' : '' }}">
					{!! Form::label('answer_4', 'D', ['class' => 'control-label']) !!}
					{!! Form::text('answer_4', null, ['class' => 'form-control']) !!}
					{!! $errors->first('answer_4', '<p class="help-block">:message</p>') !!}
				</div>
			</div>
		</div>
	</div>
</div>