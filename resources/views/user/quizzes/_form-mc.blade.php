<div id="questions-container">
	<div class="questions-wrapper row clearfix" id="question-1">
		<div class="col-xs-1 text-center">
			<strong class="count-question btn btn-primary">1</strong>
			<div style="margin: 10px 0"><button class="remove-question btn btn-danger btn-sm" disabled="true"><i class="fa fa-close"></i></button></div>
		</div>
		<div class="col-xs-11">
			<div class="form-group">
				{!! Form::label('question', 'Pertanyaan', ['class' => 'control-label']) !!}
				{!! Form::textarea('questions[1][question]', null, ['class' => 'form-control', 'id' => 'question', 'placeholder' => 'Pertanyaan...', 'rows' => '5']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('image', 'Gambar', ['class' => 'control-label']) !!}
				{!! Form::file('questions[1][image]', ['class' => 'form-control', 'id' => 'image']) !!}
			</div>
	
			<div class="row">
				<div class="form-group col-xs-12">
					<strong>Jawaban:</strong>
				</div>
				<div class="form-group col-xs-6">
					{!! Form::label('answer_1', 'A', ['class' => 'control-label']) !!}
					{!! Form::text('questions[1][answers][answer_1]', null, ['class' => 'form-control']) !!}
				</div>

				<div class="form-group col-xs-6">
					{!! Form::label('answer_2', 'B', ['class' => 'control-label']) !!}
					{!! Form::text('questions[1][answers][answer_2]', null, ['class' => 'form-control']) !!}
				</div>

				<div class="form-group col-xs-6">
					{!! Form::label('answer_3', 'C', ['class' => 'control-label']) !!}
					{!! Form::text('questions[1][answers][answer_3]', null, ['class' => 'form-control']) !!}
				</div>

				<div class="form-group col-xs-6">
					{!! Form::label('answer_4', 'D', ['class' => 'control-label']) !!}
					{!! Form::text('questions[1][answers][answer_4]', null, ['class' => 'form-control']) !!}
				</div>
			</div>
		</div>
	</div>
</div>
<div class="text-center col-md-offset-1 form-submit">
	<button class="btn btn-lg btn-block" id="add-question"><i class="fa fa-plus"></i></button>
</div>