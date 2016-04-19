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
				{!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Bagikan isi pikiran anda dikelas ini...', 'rows' => '5']) !!}
				{!! $errors->first('content', '<p class="help-block">:message</p>') !!}
			</div>

			<div class="text-right"> 
				{!! Form::submit('Bagikan', ['class'=>'btn btn-flat btn-success']) !!}
			</div>

		{!! Form::close() !!}
	</div>
	@can('manage')
	<div role="tabpanel" class="tab-pane" id="assignment">
		<div class="text-center">
			<a href="">Pilih Tugas</a> <span class="atau">atau</span> <a href="" class="btn btn-primary">Buat Tugas Baru</a>
		</div>
	</div>
	<div role="tabpanel" class="tab-pane" id="quiz">
		<div class="text-center">
			<a href="">Pilih Quiz</a> <span class="atau">atau</span> <a href="" class="btn btn-primary">Buat Quiz Baru</a>
		</div>
	</div>
	@endcan
</div>