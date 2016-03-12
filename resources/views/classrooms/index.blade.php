@extends('home')

@section('header_scripts')
<link href="{{ asset( '/css/select2.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/css/sweetalert.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('page_description')
    <a href="{{ route('classrooms.create') }}" class="btn btn-flat btn-info btn-xs"><i class="fa fa-plus"></i> Tambah Baru</a>
@endsection

@section('content')
<div class="row">
	<div class="pull-right col-xs-6 col-sm-4 col-md-3">

		{!! Form::open(['method' => 'get']) !!}
			<div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-search"></i></span>
					{!! Form::text( 'q', Request::has('q') ? Request::get('q') : null, ['class' => 'form-control', 'placeholder' => 'Cari mata pelajaran...']) !!}
				</div>
			</div>
		{!! Form::close() !!}
		
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Tabel Kelas</h3>
			</div>
			<div class="box-body">
				<table id="classrooms-datatable" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th><input type="checkbox"></input></th>
							<th>Nama</th>
							<th>Deskripsi</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($classrooms as $classroom)
							<tr>
								<td><input type="checkbox" name="id[]" value="{{ $classroom->id }}"></input></td>
		                        <td>
		                        	<div>{{ $classroom->name }}</div>
		                        	<div>
		                        		<a href="{{ route('classrooms.edit', $classroom->id) }}" class="btn btn-flat btn-link btn-xs">Edit</a>
    									{!! Form::open(['route' => ['classrooms.destroy', $classroom->id], 'method' => 'delete', 'class' => 'form-delete-inline']) !!}
        									{!! Form::submit('Hapus', ['class'=>'btn btn-flat btn-link btn-link-danger btn-xs warning-delete', 'data-title' => $classroom->name]) !!}
        								{!! Form::close() !!}
		                        	</div>
		                        </td>
		                        <td>{{ $classroom->grade }}</td>
		                    </tr>
	                    @endforeach
	                </tbody>
	                <tfoot>
						<tr>
							<th><input type="checkbox"></input></th>
							<th>Nama</th>
							<th>Deskripsi</th>
						</tr>
					</tfoot>
				</table>
				<div class="pull-right">
				@if( Request::has('q') )
					{!! $classrooms->appends(['q' => Request::get('q')])->links() !!}
				@else
					{!! $classrooms->links() !!}
				@endif
				</div>
			</div>
		</div>
	</div>
</div><!-- /.row -->
@endsection

@section('footer_scripts')
<script src="{{ asset ('/js/libs/select2.js') }}" type="text/javascript"></script>
<script src="{{ asset ('/js/admin.js') }}" type="text/javascript"></script>
@endsection