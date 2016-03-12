<div class="box-body">
    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        {!! Form::label('name', 'Nama', array('class' => 'col-md-3 control-label')) !!}
        <div class="col-md-6">
            {!! Form::text('name', null, ['class'=> 'form-control', 'autofocus' => 'autofocus', 'id' => 'name', 'autocomplete' => 'off']) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
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