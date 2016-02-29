<div class="box-body">
    <div class="form-group {{ $errors->has('identitynumber') ? 'has-error' : '' }}">
        {!! Form::label('identitynumber', 'No Induk', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('identitynumber', null, ['class'=> 'form-control', 'autofocus' => 'autofocus', 'id' => 'identitynumber', 'autocomplete' => 'off']) !!}
            {!! $errors->first('identitynumber', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
        {!! Form::label('username', 'Username', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('username', null, ['class'=> 'form-control', 'id' => 'username', 'autocomplete' => 'off']) !!}
            {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
        {!! Form::label('firstname', 'Nama Depan', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('firstname', null, ['class'=> 'form-control', 'id' => 'firstname', 'autocomplete' => 'off']) !!}
            {!! $errors->first('firstname', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
        {!! Form::label('lastname', 'Nama Belakang', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('lastname', null, ['class'=> 'form-control', 'id' => 'lastname', 'autocomplete' => 'off']) !!}
            {!! $errors->first('lastname', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
        {!! Form::label('rolelists', 'Peran', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::select('rolelists[]', App\Models\Role::lists('name','id')->all(), null, ['class'=>'form-control selectize', 'id' => 'rolelists', 'placeholder' => 'Pilih peran...'] ) !!}
            {!! $errors->first('role_lists', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        {!! Form::label('email', 'Email', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('email', null, ['class'=> 'form-control', 'id' => 'firstname', 'autocomplete' => 'off']) !!}
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="box-footer">
        <div class="col-md-offset-3">
            {!! Form::submit(isset($model) ? 'Update' : 'Save', ['class'=>'btn btn-flat btn-success']) !!}
        </div>
    </div>
</div>