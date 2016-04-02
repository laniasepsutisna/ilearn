@extends('admin.app')

@section('page_description')
    Menambahkan pengumuman baru
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">&nbsp;</h3>
            </div>
            {!! Form::open(['role' => 'form', 'class' => 'form-horizontal', 'route' => 'lms-admin.announcements.store']) !!}
                @include('admin.announcements._form')
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-4">
        @include('admin.announcements._box', ['announcements' => $announcements])
    </div>
</div>
@endsection