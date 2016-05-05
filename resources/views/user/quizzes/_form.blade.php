{!! Form::hidden('teacher_id', $lms['profile']->id) !!}

<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
	{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Judul']) !!}
	{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
	{!! Form::select('type', ['multiple_choice' => 'Pilihan Ganda', 'essay' => 'Essay'], null, ['class' => 'form-control select2', 'placeholder' => 'Tipe quiz...']) !!}
	{!! $errors->first('type', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('time_limit') ? 'has-error' : '' }}">
	{!! Form::text('time_limit', null, ['class' => 'form-control', 'placeholder' => 'Batas waktu (dalam menit).']) !!}
	{!! $errors->first('time_limit', '<p class="help-block">:message</p>') !!}
</div>

<div class="text-right"> 
	{!! Form::submit(isset($model) ? 'Update' : 'Simpan', ['class'=>'btn btn-flat btn-success']) !!}
</div>
