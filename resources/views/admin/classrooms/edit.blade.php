@extends('admin.app')

@section('page_description')
    <a href="{{ route('lms-admin.classrooms.create') }}" class="btn btn-flat btn-info btn-xs"><i class="fa fa-plus"></i> Tambah Baru</a>
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
        @include('admin.classrooms._students', ['model' => $students])
    </div>
</div>
@endsection