@extends('admin.app')

@section('page_title')
    {{ $page_title }}
@endsection

@section('page_description')
    {{ Auth::user()->fullname }}
@endsection

@section('content')
<div class="modal fade" tabindex="-1" role="dialog" id="changeImage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload Image</h4>
            </div>
            <div class="modal-body">
                {!! Form::model($user, ['route' => 'lms-admin.changeimage', 'files' => true, 'method' => 'patch']) !!}
                    {!! Form::hidden('field', 'picture', ['class' => 'field_type']) !!}
                    <div class="form-group">
                        {!! Form::label('image', 'Image', ['class' => 'sr-only']) !!}
                        {!! Form::file('image') !!}
                    </div>
                    {!! Form::submit('Update Image', ['class'=>'btn btn-flat btn-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Profile</h3>
            </div>

            <div class="cover">
                <img src="{{ $user->cover }}">
                <span id="chg-cover"><a href="#" data-toggle="modal" data-target="#changeImage">Ganti Cover</a></span>
                <figure class="picture">
                    <a href="#" id="chg-pict-button" data-toggle="modal" data-target="#changeImage">
                        <img src="{{ $user->picture_md }}">
                        <span class="chg-picture">Ganti Foto</span>
                    </a>
                </figure>
            </div> 

            {!! Form::model($user, ['route' => 'lms-admin.update', 'method' =>'patch', 'role' => 'form', 'class' => 'form-horizontal']) !!}
                @include('admin.home._form-profile', ['model' => $user])
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Change Password</h3>
            </div>
            {!! Form::open(['route' => 'lms-admin.passwordupdate', 'method' => 'patch', 'role' => 'form', 'class' => 'form-horizontal']) !!}
                <div class="box-body">
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        {!! Form::label('password', 'Password', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::password('password', ['class'=> 'form-control', 'id' => 'password']) !!}
                            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                        {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::password('password_confirmation', ['class'=> 'form-control', 'id' => 'password']) !!}
                            {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-md-offset-3">
                            {!! Form::submit('Update Password', ['class'=>'btn btn-flat btn-success']) !!}
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection