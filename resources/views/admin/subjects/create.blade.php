@extends('admin.app')

@section('page_description')
    Menambahkan Mata Pelajaran
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">&nbsp;</h3>
            </div>
            {!! Form::open(['role' => 'form', 'class' => 'form-horizontal', 'route' => 'lms-admin.subjects.store']) !!}
                @include('admin.subjects._form')
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-4">
        @include('admin.subjects._box', ['subjects' => $subjects])
    </div>
</div>
@endsection