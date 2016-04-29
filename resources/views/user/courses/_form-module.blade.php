{!! Form::hidden('course_id', $course->id) !!}

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
	{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Judul']) !!}
	{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
	{!! Form::textarea('description', null, ['class' => 'form-control textarea', 'placeholder' => 'Penjelasan...', 'rows' => '5']) !!}
	{!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('media') ? 'has-error' : '' }}">
	{!! Form::textarea('media', null, ['class' => 'form-control', 'placeholder' => 'Contoh: <iframe width="560" height="315" src="https://www.youtube.com/embed/oyEuk8j8imI" frameborder="0" allowfullscreen></iframe>', 'rows' => '5']) !!}
	{!! $errors->first('media', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
	@if(isset($model))
		{{ $model->file }}
	@endif
	<p>{!! Form::file('file') !!}</p>
	{!! $errors->first('file', '<p class="help-block">:message</p>') !!}
</div>
