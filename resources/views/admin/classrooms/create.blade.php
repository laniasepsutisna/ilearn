@extends('admin.app')

@section('page_description')
    Menambahkan Kelas
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">&nbsp;</h3>
            </div>
            {!! Form::open(['role' => 'form', 'class' => 'form-horizontal', 'route' => 'lms-admin.classrooms.store']) !!}
                @include('admin.classrooms._form')
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection