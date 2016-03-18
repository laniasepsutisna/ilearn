<div class="box-body">
    <div class="form-group {{ $errors->has('no_induk') ? 'has-error' : '' }}">
        {!! Form::label('no_induk', 'No Induk', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('no_induk', null, ['class'=> 'form-control', 'autofocus' => 'autofocus', 'id' => 'no_induk', 'autocomplete' => 'off']) !!}
            {!! $errors->first('no_induk', '<p class="help-block">:message</p>') !!}
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

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        {!! Form::label('email', 'Email', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('email', null, ['class'=> 'form-control', 'id' => 'email', 'autocomplete' => 'off']) !!}
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('dateofbirth') ? 'has-error' : '' }}">
        {!! Form::label('dateofbirth', 'Tanggal Lahir', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('dateofbirth', null, ['class'=> 'form-control datepicker', 'id' => 'dateofbirth', 'placeholder' => 'tanggal/bulan/tahun']) !!}
            {!! $errors->first('dateofbirth', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('telp_no') ? 'has-error' : '' }}">
        {!! Form::label('telp_no', 'No Telp/ HP', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('telp_no', null, ['class'=> 'form-control', 'id' => 'telp_no', 'placeholder' => 'No telp user...', 'autocomplete' => 'off']) !!}
            {!! $errors->first('telp_no', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('parent_telp_no') ? 'has-error' : '' }}">
        {!! Form::label('parent_telp_no', 'Telp/HP Orang Tua/Wali', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('parent_telp_no', null, ['class'=> 'form-control', 'id' => 'parent_telp_no', 'autocomplete' => 'off', 'placeholder' => 'No telp orang tua/ wali user. (hanya untuk siswa)']) !!}
            {!! $errors->first('parent_telp_no', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
        {!! Form::label('address', 'Alamat', array('class' => 'col-md-3 control-label')) !!}
        <div class="col-md-9">
            {!! Form::textarea('address', null, ['class' => 'form-control textarea', 'placeholder' => 'Alamat user...', 'id' => 'address']) !!}
            {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="box-footer">
        <div class="col-md-offset-3">
            {!! Form::submit('Update', ['class'=>'btn btn-flat btn-success']) !!}
        </div>
    </div>
</div>