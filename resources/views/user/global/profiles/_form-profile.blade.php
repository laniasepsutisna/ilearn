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

<div class="form-group {{ $errors->has('tempatlahir') ? 'has-error' : '' }}">
	{!! Form::label('tempatlahir', 'Tempat Lahir', ['class' => 'col-md-3 control-label']) !!}
	<div class="col-md-6">
		{!! Form::text('tempatlahir', null, ['class'=> 'form-control', 'id' => 'tempatlahir', 'autocomplete' => 'off', 'placeholder' => 'Tempat Lahir']) !!}
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

<div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
	{!! Form::label('alamat', 'Alamat', array('class' => 'col-md-3 control-label')) !!}
	<div class="col-md-8">
		{!! Form::textarea('alamat', null, ['class' => 'form-control', 'placeholder' => 'Alamat user...', 'id' => 'alamat']) !!}
		{!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group">
	<div class="col-md-offset-3">
		{!! Form::submit('Update Profile', ['class'=>'btn btn-flat btn-success']) !!}
	</div>
</div>