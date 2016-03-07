@extends('home')

@section('page_title')
    Tambah User
@endsection

@section('page_description')
    Menambahkan user baru
@endsection

@section('header_scripts')
<link href="{{ asset( '/css/select2.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Tambahkan User</h3>
            </div>
            {!! Form::open(['role' => 'form', 'class' => 'form-horizontal', 'route' => 'users.index']) !!}
                @include('users._form')
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-4">
        @include('users._box', ['users' => $users])
    </div>
</div>
@endsection


@section('footer_scripts')
<script src="{{ asset ('/js/libs/select2.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(function($){
        $('.select2').select2();
    });
</script>
@endsection