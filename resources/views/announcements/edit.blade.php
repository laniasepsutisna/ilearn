@extends('home')

@section('page_title')
    Edit Pengumuman
@endsection

@section('page_description')
    {{ $announcement->title }}
@endsection

@section('header_scripts')
<link rel="stylesheet" href="{{ asset( '/css/bootstrap3-wysihtml5.min.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $announcement->title }}</h3>
            </div>
            {!! Form::model($announcement, ['route' => ['announcements.update', $announcement], 'method' =>'patch', 'role' => 'form', 'class' => 'form-horizontal']) !!}
                @include('announcements._form', ['model' => $announcement])
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-4">
        @include('announcements._box', ['model' => $announcements])
    </div>
</div>
@endsection


@section('footer_scripts')
<script src="{{ asset('/js/libs/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script>
    jQuery(function () {
        jQuery(".textarea").wysihtml5();
    });
</script>
@endsection