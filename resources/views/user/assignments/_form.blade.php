<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
	{!! Form::label('title', 'Judul Tugas', ['class' => 'control-label']) !!}
	{!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Judul']) !!}
	{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
	{!! Form::label('content', 'Konten', ['class' => 'control-label']) !!}
		{!! Form::textarea('content', null, ['class' => 'form-control textarea', 'id' => 'content', 'placeholder' => 'Deskripsi tugas...', 'rows' => '5']) !!}
		{!! $errors->first('content', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
	{!! Form::label('file', 'File', ['class' => 'control-label']) !!}
		{!! Form::file('file', ['id' => 'file']) !!}
		{!! $errors->first('file', '<p class="help-block">:message</p>') !!}
		@if(isset($model) && $assignment->file)
			<p><i class="fa fa-paperclip"></i> {{ $assignment->file }}</p>
		@endif
</div>

<div class="form-group"> 
	{!! Form::button('<i class="fa fa-send"></i> Simpan', ['class'=>'btn btn-flat btn-success', 'type' => 'submit']) !!}
</div>
