@extends('admin.app')

@section('page_description')
    <a href="{{ route('lms-admin.majors.create') }}" class="btn btn-flat btn-info btn-xs"><i class="fa fa-plus"></i> Tambah Baru</a>
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
				<h3 class="box-title">Tabel Jurusan</h3>
			</div>
			<div class="box-body">
				<table id="majors-datatable" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th><input type="checkbox"></input></th>
							<th>Nama</th>
							<th>Deskripsi</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($majors as $major)
							<tr>
								<td><input type="checkbox" name="id[]" value="{{ $major->id }}"></input></td>
		                        <td>
		                        	<div>{{ $major->name }}</div>
		                        	<div>
		                        		<a href="{{ route('lms-admin.majors.edit', $major->id) }}" class="btn btn-flat btn-link btn-xs">Edit</a>
    									{!! Form::open(['route' => ['lms-admin.majors.destroy', $major->id], 'method' => 'delete', 'class' => 'form-delete-inline']) !!}
        									{!! Form::submit('Hapus', ['class'=>'btn btn-flat btn-link btn-link-danger btn-xs warning-delete', 'data-title' => $major->name]) !!}
        								{!! Form::close() !!}
		                        	</div>
		                        </td>
		                        <td>{!! $major->description !!}</td>
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
					{!! $majors->appends(['q' => Request::get('q')])->links() !!}
				@else
					{!! $majors->links() !!}
				@endif
				</div>
			</div>
		</div>
	</div>
</div><!-- /.row -->
@endsection