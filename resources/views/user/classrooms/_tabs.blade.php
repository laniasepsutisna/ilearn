<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active">
		<a href="#discussion" aria-controls="settings" role="tab" data-toggle="tab">Diskusi</a>
	</li>
	@can('manage')
	<li role="presentation">
		<a href="#module" aria-controls="settings" role="tab" data-toggle="tab">Materi</a>
	</li>
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
				{!! Form::textarea('content', null, ['class' => 'form-control discuss-textarea', 'placeholder' => 'Bagikan isi pikiran anda dikelas ini...', 'rows' => '2']) !!}
				{!! $errors->first('content', '<p class="help-block">:message</p>') !!}
			</div>

			<div class="text-right"> 
				{!! Form::submit('Bagikan', ['class'=>'btn btn-flat btn-success']) !!}
			</div>

		{!! Form::close() !!}
	</div>
	@can('manage')
	<div role="tabpanel" class="tab-pane" id="module">
		<div class="text-center">
			<a href="#" id="selectModule">Pilih Materi</a> <span class="atau">atau</span> <a href="{{ route('courses.create') }}" class="btn btn-primary">Buat Materi Baru</a>
		</div>
	</div>
	<div role="tabpanel" class="tab-pane" id="assignment">
		<div class="text-center">
			<a href="#" id="selectAssignment">Pilih Tugas</a> <span class="atau">atau</span> <a href="{{ route('assignments.create') }}" class="btn btn-primary">Buat Tugas Baru</a>
		</div>
	</div>
	<div role="tabpanel" class="tab-pane" id="quiz">
		<div class="text-center">
			<a href="#" id="selectQuiz">Pilih Quiz</a> <span class="atau">atau</span> <a href="{{ route('quizes.create') }}" class="btn btn-primary">Buat Quiz Baru</a>
		</div>
	</div>
	@endcan
</div>