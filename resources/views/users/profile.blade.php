@extends('home')

@section('page_title')
    {{ $page_title }}
@endsection

@section('page_description')
    {{ Auth::user()->fullname }}
@endsection

@section('header_scripts')
<link href="{{ asset( '/css/select2.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset( '/css/datepicker3.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Profile</h3>
            </div>
            {!!Form::model($user, ['route' => ['auth.update', $user], 'method' =>'patch', 'role' => 'form', 'class' => 'form-horizontal']) !!}
                @include('users._form-profile', ['model' => $user])
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Change Password</h3>
            </div>
            {!! Form::open(['url' => route('auth.passwordupdate', $user->id), 'method' => 'patch', 'role' => 'form', 'class' => 'form-horizontal']) !!}
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


@section('footer_scripts')
<script src="{{ asset ('/js/libs/select2.js') }}" type="text/javascript"></script>
<script src="{{ asset ('/js/libs/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(function($){
        $('.select2').select2();
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            startDate: '01/01/1940'
        });
    });
</script>
@endsection