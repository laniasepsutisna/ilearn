@extends('home')

@section('page_description')
    <a href="{{ route('subjects.create') }}" class="btn btn-flat btn-info btn-xs"><i class="fa fa-plus"></i> Tambah Baru</a>
@endsection

@section('header_scripts')
<link href="{{ asset( '/css/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset( '/css/select2.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $subject->name }}</h3>
            </div>
            {!! Form::model($subject, ['route' => ['subjects.update', $subject], 'method' =>'patch', 'role' => 'form', 'class' => 'form-horizontal']) !!}
                @include('subjects._form', ['model' => $subject])
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-4">
        @include('subjects._box', ['model' => $subjects])
    </div>
</div>
@endsection


@section('footer_scripts')
<script src="{{ asset('/js/libs/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ asset ('/js/libs/select2.js') }}" type="text/javascript"></script>
<script>
    jQuery(function ($) {
        $(".textarea").wysihtml5();
        $('.select2').select2();
    });
</script>
@endsection