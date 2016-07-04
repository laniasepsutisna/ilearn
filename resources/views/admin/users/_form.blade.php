<div class="box-body">

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
        {!! Form::label('role', 'Peran', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::select('role', ['staff' => 'Tata Usaha', 'teacher' => 'Guru', 'student' => 'Siswa'], null, ['class'=>'form-control select2', 'id' => 'role', 'placeholder' => 'Pilih peran...'] ) !!}
            {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        {!! Form::label('email', 'Email', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('email', null, ['class'=> 'form-control', 'id' => 'email', 'autocomplete' => 'off']) !!}
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('bio') ? 'has-error' : '' }}">
        {!! Form::label('bio', 'Biografi', array('class' => 'col-md-3 control-label')) !!}
        <div class="col-md-9">
            {!! Form::textarea('bio', null, ['class' => 'form-control', 'placeholder' => 'Biografi...', 'id' => 'bio']) !!}
            {!! $errors->first('bio', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

@if(isset($user) && $user->role == 'student')
    <h3>Data Siswa</h3>

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

    <div class="form-group {{ $errors->has('agama') ? 'has-error' : '' }}">
        {!! Form::label('agama', 'Agama', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::select('agama', ['Budha' => 'Budha', 'Hindu' => 'Hindu', 'Islam' => 'Islam', 'Katholik' => 'Katholik', 'Kristen' => 'Kristen'], null, ['class'=>'form-control select2', 'id' => 'agama', 'placeholder' => 'Pilih Agama...'] ) !!}
            {!! $errors->first('agama', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('major') ? 'has-error' : '' }}">
        {!! Form::label('major', 'Jurusan', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::select('major_id', App\Models\Major::pluck('name', 'id'), null, ['class'=>'form-control select2', 'id' => 'major', 'placeholder' => 'Pilih Jurusan...'] ) !!}
            {!! $errors->first('major', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('telp') ? 'has-error' : '' }}">
        {!! Form::label('telp', 'No Telp/ HP', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('telp', null, ['class'=> 'form-control', 'id' => 'telp', 'placeholder' => 'No telp user...', 'autocomplete' => 'off']) !!}
            {!! $errors->first('telp', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
        {!! Form::label('alamat', 'Alamat', array('class' => 'col-md-3 control-label')) !!}
        <div class="col-md-9">
            {!! Form::textarea('alamat', null, ['class' => 'form-control', 'placeholder' => 'Alamat user...', 'id' => 'alamat']) !!}
            {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
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

@if(Route::currentRouteName('lms-index.users.edit'))
    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
        {!! Form::label('status', 'Status', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::select('status', ['active' => 'Active', 'banned' => 'Banned'], null, ['class'=>'form-control select2', 'id' => 'status', 'placeholder' => 'Status Akun...'] ) !!}
            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
@endif

    <div class="box-footer">
        <div class="col-md-offset-3">
            {!! Form::submit('Update', ['class'=>'btn btn-flat btn-success']) !!}
        </div>
    </div>
</div>