@extends('front')

@section('page_title')
    Reset Password
@endsection

@section('content')
<div class="overlay"></div>
<div class="container password-reset">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {!! Form::open(['url' => route('email.store'), 'role' => 'form', 'class' => 'form-horizontal']) !!}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::label('email', 'Email', ['class' => 'col-md-4 control-label']); !!}
                            <div class="col-md-6">
                                {!! Form::text('email', null, ['class' => 'form-control']) !!}
                                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-envelope"></i> Kirim Link Reset
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection