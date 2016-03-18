@extends('admin.home')

@section('page_description')
    <a href="{{ route('lms-admin.classrooms.create') }}" class="btn btn-flat btn-info btn-xs"><i class="fa fa-plus"></i> Tambah Baru</a>
@endsection

@section('header_scripts')
<link href="{{ asset( '/css/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset( '/css/select2.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="row">
    <div class="col-md-7">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit {{ $classroom->classname }}</h3>                
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            {!! Form::model($classroom, ['route' => ['lms-admin.classrooms.update', $classroom], 'method' =>'patch', 'role' => 'form', 'class' => 'form-horizontal']) !!}
                @include('admin.classrooms._form', ['model' => $classroom])
            {!! Form::close() !!}
        </div>
    </div>

    <div class="col-md-5">
        @include('admin.classrooms._teachers', ['model' => $users])
        @include('admin.classrooms._students', ['model' => $users])
    </div>
</div>
@endsection


@section('footer_scripts')
<script src="{{ asset('/js/libs/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ asset ('/js/libs/select2.js') }}" type="text/javascript"></script>
<script>
    (function($){        
        $(function () {
            $(".textarea").wysihtml5();

            $('.select2').select2();
        });
    })(jQuery);
</script>
@endsection