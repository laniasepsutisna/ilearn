{!! Form::hidden('teacher_id', $lms['profile']->id) !!}

<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
	{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Judul']) !!}
	{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
	{!! Form::textarea('content', null, ['class' => 'form-control textarea', 'placeholder' => 'Deskripsi tugas...', 'rows' => '5']) !!}
	{!! $errors->first('content', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
	<p>{!! Form::file('file') !!}</p>
	@if(isset($model) && $assignment->file)
		<p><i class="fa fa-paperclip"></i> {{ $assignment->file }}</p>
	@endif
	{!! $errors->first('file', '<p class="help-block">:message</p>') !!}
</div>

<div class="text-right"> 
	{!! Form::submit(isset($model) ? 'Update' : 'Simpan', ['class'=>'btn btn-flat btn-success']) !!}
</div>
