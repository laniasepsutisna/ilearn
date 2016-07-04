<div class="box-body">
    <h3>Data Siswa</h3>    
    @if(isset($user) && $user->role == 'student')
    <div class="form-group {{ $errors->has('nis') ? 'has-error' : '' }}">
        {!! Form::label('nis', 'NIS', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('nis', null, ['class'=> 'form-control', 'autofocus' => 'autofocus', 'id' => 'nis', 'autocomplete' => 'off']) !!}
            {!! $errors->first('nis', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('nisn') ? 'has-error' : '' }}">
        {!! Form::label('nisn', 'NISN', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('nisn', null, ['class'=> 'form-control', 'autofocus' => 'autofocus', 'id' => 'nisn', 'autocomplete' => 'off']) !!}
            {!! $errors->first('nisn', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('orangtua') ? 'has-error' : '' }}">
        {!! Form::label('orangtua', 'Nama Orang Tua', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('orangtua', null, ['class'=> 'form-control', 'id' => 'orangtua', 'autocomplete' => 'off', 'Nama orang tua siswa.']) !!}
            {!! $errors->first('orangtua', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    
    <div class="form-group {{ $errors->has('wali') ? 'has-error' : '' }}">
        {!! Form::label('wali', 'Wali', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('wali', null, ['class'=> 'form-control', 'id' => 'wali', 'autocomplete' => 'off', 'placeholder' => 'Nama wali Siswa...']) !!}
            {!! $errors->first('wali', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    
    <div class="form-group {{ $errors->has('telp_orangtua') ? 'has-error' : '' }}">
        {!! Form::label('telp_orangtua', 'Telp/HP Orang Tua/Wali', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('telp_orangtua', null, ['class'=> 'form-control', 'id' => 'telp_orangtua', 'autocomplete' => 'off', 'placeholder' => 'No telp orang tua/ wali user. (hanya untuk siswa)']) !!}
            {!! $errors->first('telp_orangtua', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    @endif

    <div class="form-group {{ $errors->has('tempatlahir') ? 'has-error' : '' }}">
        {!! Form::label('tempatlahir', 'Tempat Lahir', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('tempatlahir', null, ['class'=> 'form-control', 'autofocus' => 'autofocus', 'id' => 'tempatlahir', 'autocomplete' => 'off']) !!}
            {!! $errors->first('tempatlahir', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('tanggallahir') ? 'has-error' : '' }}">
        {!! Form::label('tanggallahir', 'Tanggal Lahir', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('tanggallahir', null, ['class'=> 'form-control datepicker', 'id' => 'tanggallahir', 'placeholder' => 'tanggal/bulan/tahun']) !!}
            {!! $errors->first('tanggallahir', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('telp') ? 'has-error' : '' }}">
        {!! Form::label('telp', 'No Telp/ HP', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('telp', null, ['class'=> 'form-control', 'id' => 'telp', 'placeholder' => 'No telp user...', 'autocomplete' => 'off']) !!}
            {!! $errors->first('telp', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('agama') ? 'has-error' : '' }}">
        {!! Form::label('agama', 'Agama', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::select('agama', ['Budha' => 'Budha', 'Hindu' => 'Hindu', 'Islam' => 'Islam', 'Katholik' => 'Katholik', 'Kristen' => 'Kristen'], null, ['class'=>'form-control select2', 'id' => 'agama', 'placeholder' => 'Pilih Agama...'] ) !!}
            {!! $errors->first('agama', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
        {!! Form::label('alamat', 'Alamat', array('class' => 'col-md-3 control-label')) !!}
        <div class="col-md-9">
            {!! Form::textarea('alamat', null, ['class' => 'form-control', 'placeholder' => 'Alamat user...', 'id' => 'alamat', 'rows' => '3']) !!}
            {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('bio') ? 'has-error' : '' }}">
        {!! Form::label('bio', 'Biografi', array('class' => 'col-md-3 control-label')) !!}
        <div class="col-md-9">
            {!! Form::textarea('bio', null, ['class' => 'form-control', 'placeholder' => 'Biografi...', 'id' => 'bio', 'rows' => '3']) !!}
            {!! $errors->first('bio', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="box-footer">
        <div class="col-md-offset-3">
            {!! Form::submit('Update', ['class'=>'btn btn-flat btn-success']) !!}
        </div>
    </div>
</div>