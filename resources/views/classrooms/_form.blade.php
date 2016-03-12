<div class="box-body">
    <div class="form-group {{ $errors->has('grade') ? 'has-error' : '' }}">
        {!! Form::label('grade', 'Kelas', array('class' => 'col-md-3 control-label')) !!}
        <div class="col-md-6">
            {!! Form::select('grade', [ '1' => 'I', '2' => 'II', '3' => 'III', '4' => 'IV', '5' => 'V', '6' => 'VI', '7' => 'VII', '8' => 'VIII', '9' => 'IX', '10' => 'X', '11' => 'XI', '12' => 'XII'], null, ['class' => 'form-control select2', 'id' => 'grade', 'placeholder' => 'Pilih Kelas...']) !!}                            
            {!! $errors->first('grade', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('major') ? 'has-error' : '' }}">
        {!! Form::label('major', 'Jurusan', array('class' => 'col-md-3 control-label')) !!}
        <div class="col-md-6">
            {!! Form::select('major', App\Models\Major::pluck('name', 'id'), null, ['class' => 'form-control select2', 'id' => 'major', 'placeholder' => 'Pilih Jurusan...']) !!}                            
            {!! $errors->first('major', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
        {!! Form::label('subject', 'Mata Pelajaran', array('class' => 'col-md-3 control-label')) !!}
        <div class="col-md-6">
            {!! Form::select('subject', App\Models\Subject::pluck('name', 'id'), null, ['class' => 'form-control select2', 'id' => 'subject', 'placeholder' => 'Pilih Mata Pelajaran...']) !!}                            
            {!! $errors->first('subject', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
        {!! Form::label('description', 'Deskripsi', array('class' => 'col-md-3 control-label')) !!}
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