<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
	{!! Form::label('title', 'Judul Quiz', ['class' => 'control-label']) !!}
	{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Judul', 'id' => 'title']) !!}
	{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('pass_score') ? 'has-error' : '' }}">
	{!! Form::label('pass_score', 'Skor Minimal', ['class' => 'control-label']) !!}
	{!! Form::select('pass_score', [40 => 40, 45 => 45, 50 => 50, 55 => 55, 60 => 60, 65 => 65, 70 => 70, 75 => 75, 80 => 80, 85 => 85], null, ['class' => 'select2', 'placeholder' => 'Skor minimal', 'id' => 'pass_score']) !!}
	{!! $errors->first('pass_score', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('time_limit') ? 'has-error' : '' }}">
	{!! Form::label('time_limit', 'Batas Waktu', ['class' => 'control-label']) !!}
	{!! Form::select('time_limit', [10 => 10, 30 => 30, 60 => 60, 90 => 90, 120 => 120, 180 => 180], null, ['class' => 'select2', 'placeholder' => 'Batas waktu', 'id' => 'time_limit']) !!}
	{!! $errors->first('time_limit', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group"> 
	{!! Form::button('<i class="fa fa-send"></i> Simpan', ['class'=>'btn btn-flat btn-success', 'type' => 'submit', 'id' => 'quizSubmit']) !!}
</div>
