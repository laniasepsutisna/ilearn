<div class="box-body">
    <input type="hidden" value="{{ $lms['profile']->id }}" name="user_id">
    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
        {!! Form::label('title', 'Judul Pengumuman', array('class' => 'col-md-3 control-label')) !!}
        <div class="col-md-6">
            {!! Form::text('title', null, ['class'=> 'form-control', 'autofocus' => 'autofocus', 'id' => 'title', 'autocomplete' => 'off']) !!}
            {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
        {!! Form::label('urgensi', 'Urgensi', array('class' => 'col-md-3 control-label')) !!}
        <div class="col-md-6">
            {!! Form::select('status', ['info' => 'Hanya Info', 'danger' => 'Sangat Penting'], null, ['class' => 'form-control select2', 'id' => 'urgensi', 'placeholder' => 'Pilih tipe urgensi...']) !!}                            
            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
        {!! Form::label('konten-pengumuman', 'Konten Pengumuman', array('class' => 'col-md-3 control-label')) !!}
        <div class="col-md-9">
            {!! Form::textarea('content', null, ['class' => 'form-control textarea', 'placeholder' => 'Deskripsi pengumuman...', 'id' => 'konten-pengumuman']) !!}
            {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="box-footer">
        <div class="col-md-offset-3">
            {!! Form::submit(isset($model) ? 'Update' : 'Save', ['class'=>'btn btn-flat btn-success']) !!}
        </div>
    </div>
</div>