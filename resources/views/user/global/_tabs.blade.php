<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active">
		<a href="#discussion" aria-controls="settings" role="tab" data-toggle="tab">Diskusi</a>
	</li>
</ul>

<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="discussion">
		{!! Form::open(['route' => 'discuss.store']) !!}

			{!! Form::hidden('user_id', $lms['profile']->id) !!}

			<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
				{!! Form::textarea('content', null, ['class' => 'form-control discuss-textarea', 'placeholder' => 'Bagikan isi pikiran anda di tiap kelas...', 'rows' => '2']) !!}
				{!! $errors->first('content', '<p class="help-block">:message</p>') !!}
			</div>
			
			<div class="form-group {{ $errors->has('classroom_id') ? 'has-error' : '' }}"> 
				{!! Form::select('classroom_id', $lms['classrooms']->pluck('classname', 'id'), 'Pilih Kelas...', ['class' => 'select2 form-control', 'placeholder' => 'Pilih kelas...'])  !!}
				{!! $errors->first('classroom_id', '<p class="help-block">:message</p>') !!}
			</div>

			<div class="text-right"> 
				{!! Form::button('<i class="fa fa-send"></i> Bagikan', ['class'=>'btn btn-flat btn-primary', 'type' => 'submit']) !!}
			</div>

		{!! Form::close() !!}
	</div>
</div>