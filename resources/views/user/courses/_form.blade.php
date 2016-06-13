{!! Form::hidden('teacher_id', $lms['profile']->id) !!}

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
	{!! Form::label('name', 'Nama Materi', ['class' => 'control-label']) !!}
	{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Judul']) !!}
	{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('level') ? 'has-error' : '' }}">
	{!! Form::label('level', 'Level', ['class' => 'control-label']) !!}
	{!! Form::select('level', ['mudah' => 'Mudah', 'normal' => 'Normal', 'sulit' => 'Sulit'], null, ['class' => 'select2', 'id' => 'level']) !!}
	{!! $errors->first('level', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
	{!! Form::label('description', 'Deskripsi', ['class' => 'control-label']) !!}
	{!! Form::textarea('description', null, ['class' => 'form-control textarea', 'placeholder' => 'Deskripsi tugas...', 'rows' => '5', 'id' => 'description']) !!}
	{!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('picture') ? 'has-error' : '' }}">
	{!! Form::label('foto', 'Gambar', ['class' => 'control-label']) !!}
	{!! Form::label('foto', 'Foto', ['class' => 'control-label', 'id' => 'foto']) !!}
	@if(isset($model))
		<p><img width="100" height="100" src="{{ url($model->picture_sm) }}" /></p>
	@endif
	<p>{!! Form::file('picture', ['id' => 'foto']) !!}</p>
	{!! $errors->first('picture', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group"> 
	{!! Form::button('<i class="fa fa-send"></i> Simpan', ['class'=>'btn btn-flat btn-success', 'type' => 'submit']) !!}
</div>