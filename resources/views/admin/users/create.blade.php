@extends('admin.app')

@section('page_title')
    Tambah User
@endsection

@section('page_description')
    Menambahkan user baru
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Tambahkan User</h3>
            </div>
            {!! Form::open(['role' => 'form', 'class' => 'form-horizontal', 'route' => 'lms-admin.users.store']) !!}
                @include('admin.users._form')
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-4">
        @include('admin.users._box', ['users' => $users])
    </div>
</div>
@endsection