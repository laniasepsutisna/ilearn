<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active">
		<a href="#discussion" aria-controls="settings" role="tab" data-toggle="tab">Diskusi</a>
	</li>
	@can('manage')
	<li role="presentation">
		<a href="#assignment" aria-controls="settings" role="tab" data-toggle="tab">Tugas</a>
	</li>
	<li role="presentation">
		<a href="#quiz" aria-controls="settings" role="tab" data-toggle="tab">Quiz</a>
	</li>
	@endcan
</ul>

<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="discussion">
		{!! Form::open(['route' => 'discuss.store']) !!}
			{!! Form::hidden('classroom_id', $classroom->id) !!}
			{!! Form::hidden('user_id', $lms['profile']->id) !!}
			<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
				{!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Bagikan isi pikiran anda dikelas ini...']) !!}
				{!! $errors->first('content', '<p class="help-block">:message</p>') !!}
			</div>
			<div class="text-right"> 
				{!! Form::submit('Bagikan', ['class'=>'btn btn-flat btn-success']) !!}
			</div>
		{!! Form::close() !!}
	</div>
	@can('manage')
	<div role="tabpanel" class="tab-pane" id="assignment">
		{!! Form::open() !!}
			<div class="form-group {{ $errors->has('assignment') ? 'has-error' : '' }}">
				{!! Form::text('assignment', null, ['class' => 'form-control', 'placeholder' => 'Judul']) !!}
				{!! $errors->first('assignment', '<p class="help-block">:message</p>') !!}
			</div>
			<div class="form-group {{ $errors->has('deadline') ? 'has-error' : '' }}">
				{!! Form::text('deadline', null, ['class' => 'form-control', 'placeholder' => 'Deadline']) !!}
				{!! $errors->first('deadline', '<p class="help-block">:message</p>') !!}
			</div>
			<div class="text-right"> 
				{!! Form::submit('Bagikan', ['class'=>'btn btn-flat btn-success']) !!}
			</div>
		{!! Form::close() !!}
	</div>
	<div role="tabpanel" class="tab-pane" id="quiz">
		{!! Form::open() !!}
			<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
				{!! Form::textarea('content', null, ['class' => 'form-control textarea', 'placeholder' => 'Mulai diskusi?']) !!}
				{!! $errors->first('content', '<p class="help-block">:message</p>') !!}
			</div>
			<div class="text-right"> 
				{!! Form::submit('Bagikan', ['class'=>'btn btn-flat btn-success']) !!}
			</div>
		{!! Form::close() !!}
	</div>
	@endcan
</div>