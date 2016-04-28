{!! Form::hidden('teacher_id', $lms['profile']->id) !!}

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
	{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Judul']) !!}
	{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('level') ? 'has-error' : '' }}">
	{!! Form::select('level', ['mudah' => 'Mudah', 'normal' => 'Normal', 'sulit' => 'Sulit'], null, ['class' => 'select2']) !!}
	{!! $errors->first('level', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
	{!! Form::textarea('description', null, ['class' => 'form-control textarea', 'placeholder' => 'Deskripsi tugas...', 'rows' => '5']) !!}
	{!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('picture') ? 'has-error' : '' }}">
	<img src="{{ url($model->picture_sm) }}" />
	<p>{!! Form::file('picture') !!}</p>
	{!! $errors->first('picture', '<p class="help-block">:message</p>') !!}
</div>

<div class="text-right"> 
	{!! Form::submit(isset($model) ? 'Update Tugas' : 'Buat Tugas', ['class'=>'btn btn-flat btn-success']) !!}
</div>
