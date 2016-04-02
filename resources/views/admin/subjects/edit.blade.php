@extends('admin.app')

@section('page_description')
    <a href="{{ route('lms-admin.subjects.create') }}" class="btn btn-flat btn-info btn-xs"><i class="fa fa-plus"></i> Tambah Baru</a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $subject->name }}</h3>
            </div>
            {!! Form::model($subject, ['route' => ['lms-admin.subjects.update', $subject], 'method' =>'patch', 'role' => 'form', 'class' => 'form-horizontal']) !!}
                @include('admin.subjects._form', ['model' => $subject])
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-4">
        @include('admin.subjects._box', ['model' => $subjects])
    </div>
</div>
@endsection