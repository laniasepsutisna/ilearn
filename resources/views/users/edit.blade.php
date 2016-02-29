@extends('home')

@section('page_title')
    Edit User
@endsection

@section('page_description')
    {{ $user->fullname }}
@endsection

@section('header_scripts')
<link href="{{ asset( '/css/selectize.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset( '/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $user->fullname }}</h3>
            </div>
            {!! Form::model($user, ['route' => ['users.update', $user], 'method' =>'patch', 'role' => 'form', 'class' => 'form-horizontal']) !!}
                @include('users._form', ['model' => $user])
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-4">
        @include('users._box', ['model' => $users])
    </div>
</div>
@endsection


@section('footer_scripts')
<script src="{{ asset ('/js/libs/selectize.js') }}" type="text/javascript"></script>
@endsection