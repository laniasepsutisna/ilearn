{!! Form::hidden('teacher_id', $lms['profile']->id) !!}

<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
	{!! Form::label('title', 'Judul Quiz', ['class' => 'control-label']) !!}
	{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Judul', 'id' => 'title']) !!}
	{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('pass_score') ? 'has-error' : '' }}">
	{!! Form::label('pass_score', 'Skor Minimal', ['class' => 'control-label']) !!}
	{!! Form::text('pass_score', null, ['class' => 'form-control', 'placeholder' => 'Skor minimal (0 sampai 100)', 'id' => 'pass_score']) !!}
	{!! $errors->first('pass_score', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('time_limit') ? 'has-error' : '' }}">
	{!! Form::label('time_limit', 'Batas Waktu', ['class' => 'control-label']) !!}
	{!! Form::text('time_limit', null, ['class' => 'form-control', 'placeholder' => 'Batas waktu (dalam menit).', 'id' => 'time_limit']) !!}
	{!! $errors->first('time_limit', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group"> 
	{!! Form::button('<i class="fa fa-send"></i> Simpan', ['class'=>'btn btn-flat btn-success', 'type' => 'submit']) !!}
</div>
