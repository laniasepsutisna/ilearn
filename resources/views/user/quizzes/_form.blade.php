{!! Form::hidden('teacher_id', $lms['profile']->id) !!}

<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
	{!! Form::label('title', 'Judul Quiz', ['class' => 'control-label']) !!}
	{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Judul', 'id' => 'title']) !!}
	{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('time_limit') ? 'has-error' : '' }}">
	{!! Form::label('time_limit', 'Batas Waktu', ['class' => 'control-label']) !!}
	{!! Form::text('time_limit', null, ['class' => 'form-control', 'placeholder' => 'Batas waktu (dalam menit).', 'id' => 'time_limit']) !!}
	{!! $errors->first('time_limit', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group"> 
	{!! Form::button('<i class="fa fa-send"></i> Simpan', ['class'=>'btn btn-flat btn-success', 'type' => 'submit']) !!}
</div>
