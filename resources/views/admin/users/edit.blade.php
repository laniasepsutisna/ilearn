@extends('admin.app')

@section('page_title')
    Edit User
@endsection

@section('page_description')
    {{ $user->fullname }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $user->fullname }}</h3>
            </div>
            {!! Form::model($user, ['route' => ['lms-admin.users.update', $user], 'method' =>'patch', 'role' => 'form', 'class' => 'form-horizontal']) !!}
                @include('admin.users._form', ['model' => $user])
            {!! Form::close() !!}
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Biografi</h3>
                {!! Form::model($user, ['route' => ['lms-admin.users.updatemeta', $user], 'method' =>'patch', 'role' => 'form', 'class' => 'form-horizontal']) !!}
                    @include('admin.users._form-usermeta', ['model' => $user])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        @include('admin.users._box', ['model' => $users])
    </div>
</div>
@endsection