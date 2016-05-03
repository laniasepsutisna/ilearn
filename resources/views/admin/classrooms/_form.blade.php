<div class="box-body">
    <div class="form-group {{ $errors->has('grade') ? 'has-error' : '' }}">
        {!! Form::label('grade', 'Kelas', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::select('grade', ['XII' => 'XII (Dua Belas)', 'XI' => 'XI (Sebelas)', 'X' => 'X (Sepuluh)', 'IX' => 'IX (Sembilan)', 'VIII' => 'VIII (Delapan)', 'VII' => 'VII (Tujuh)'], null, ['class' => 'form-control select2', 'id' => 'grade', 'placeholder' => 'Pilih Kelas...']) !!}                            
            {!! $errors->first('grade', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('major_id') ? 'has-error' : '' }}">
        {!! Form::label('major_id', 'Jurusan', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::select('major_id', App\Models\Major::pluck('name', 'id'), null, ['class' => 'form-control select2', 'id' => 'major_id', 'placeholder' => 'Pilih Jurusan...']) !!}                            
            {!! $errors->first('major_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('subject_id') ? 'has-error' : '' }}">
        {!! Form::label('subject_id', 'Mata Pelajaran', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::select('subject_id', App\Models\Subject::pluck('name', 'id'), null, ['class' => 'form-control select2', 'id' => 'subject_id', 'placeholder' => 'Pilih Mata Pelajaran...']) !!}                            
            {!! $errors->first('subject_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('teacher_id') ? 'has-error' : '' }}">
        {!! Form::label('teacher_id', 'Guru', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::select('teacher_id', App\Models\User::where('role', 'teacher')->get()->pluck('fullname', 'id'), null, ['class' => 'form-control select2', 'id' => 'teacher_id', 'placeholder' => 'Guru...']) !!}                            
            {!! $errors->first('teacher_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
        {!! Form::label('description', 'Deskripsi', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-9">
            {!! Form::textarea('description', null, ['class' => 'form-control textarea', 'placeholder' => 'Deskripsi...', 'id' => 'description']) !!}
            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="box-footer">
        <div class="col-md-offset-3">
            {!! Form::submit(isset($model) ? 'Update' : 'Save', ['class'=>'btn btn-flat btn-success']) !!}
        </div>
    </div>
</div>