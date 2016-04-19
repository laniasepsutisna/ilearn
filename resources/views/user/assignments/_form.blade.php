
{!! Form::open(['route' => 'assignments.store', 'files' => true]) !!}

	{!! Form::hidden('classroom_id', $classroom->id) !!}
	{!! Form::hidden('user_id', $lms['profile']->id) !!}

	<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
		{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Judul']) !!}
		{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="form-group {{ $errors->has('deadline') ? 'has-error' : '' }}">
		{!! Form::text('deadline', null, ['class' => 'form-control', 'placeholder' => 'Deadline']) !!}
		{!! $errors->first('deadline', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
		{!! Form::file('file') !!}
		{!! $errors->first('file', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
		{!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Deskripsi tugas...', 'rows' => '5']) !!}
		{!! $errors->first('content', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="text-right"> 
		{!! Form::submit('Bagikan', ['class'=>'btn btn-flat btn-success']) !!}
	</div>

{!! Form::close() !!}
