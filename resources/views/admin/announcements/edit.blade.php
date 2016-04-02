@extends('admin.app')

@section('page_description')
    <a href="{{ route('lms-admin.announcements.create') }}" class="btn btn-flat btn-info btn-xs"><i class="fa fa-plus"></i> Tambah Baru</a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $announcement->title }}</h3>
            </div>
            {!! Form::model($announcement, ['route' => ['lms-admin.announcements.update', $announcement], 'method' =>'patch', 'role' => 'form', 'class' => 'form-horizontal']) !!}
                @include('admin.announcements._form', ['model' => $announcement])
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-4">
        @include('admin.announcements._box', ['model' => $announcements])
    </div>
</div>
@endsection