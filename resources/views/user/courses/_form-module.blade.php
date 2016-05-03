@if(isset($model))
	{!! Form::hidden('course_id', $model->course->id) !!}
@else
	{!! Form::hidden('course_id', $course->id) !!}
@endif

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
	{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Judul']) !!}
	{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
	{!! Form::textarea('description', null, ['class' => 'form-control textarea', 'placeholder' => 'Penjelasan...', 'rows' => '5']) !!}
	{!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('media') ? 'has-error' : '' }}">
	{!! Form::label('media', 'Media', ['class' => 'control-label']) !!}
	{!! Form::textarea('media', null, ['class' => 'form-control', 'placeholder' => 'Contoh: <iframe width="560" height="315" src="https://www.youtube.com/embed/oyEuk8j8imI" frameborder="0" allowfullscreen></iframe>', 'id' => 'media', 'rows' => '5']) !!}
	{!! $errors->first('media', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
	<p>{!! Form::file('file') !!}</p>	
	@if(isset($model))
		<i class="fa fa-paperclip"></i> {{ $model->file }}
	@endif
	{!! $errors->first('file', '<p class="help-block">:message</p>') !!}
</div>