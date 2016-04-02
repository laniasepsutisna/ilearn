@extends('admin.app')

@section('page_description')
    Menambahkan Jurusan
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">&nbsp;</h3>
            </div>
            {!! Form::open(['role' => 'form', 'class' => 'form-horizontal', 'route' => 'lms-admin.majors.store']) !!}
                @include('admin.majors._form')
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-4">
        @include('admin.majors._box', ['majors' => $majors])
    </div>
</div>
@endsection