@extends('home')

@section('header_scripts')
@endsection

@section('page_title')
	Users
@endsection

@section('page_description')
    <a href="{{ route('users.create', ['type' => Request::get('type')]) }}" class="btn btn-flat btn-info btn-xs"><i class="fa fa-plus"></i> Tambah Baru</a>
@endsection

@section('content')
<div class="row">
	<div class="pull-right col-xs-6 col-sm-4 col-md-3">

		{!! Form::open(['method' => 'get']) !!}
			<div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
				{!! Form::hidden('type', Request::get('type') ? Request::get('type') : 'staff') !!}
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-search"></i></span>
					{!! Form::text( 'q', Request::has('q') ? Request::get('q') : null, ['class' => 'form-control', 'placeholder' => 'Cari user...']) !!}
				</div>
			</div>
		{!! Form::close() !!}
		
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Tabel User</h3>
			</div>
			<div class="box-body">
				<table id="users-datatable" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th><input type="checkbox"></input></th>
							<th>Nama</th>
							<th>Email</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $u)
							<tr>
								<td><input type="checkbox" name="id[]" value="{{ $u->id }}"></input></td>
		                        <td>
		                        	<div>
		                        		<a href="{{ route('users.edit', $u->id) }}">{{ $u->fullName }}</a>
		                        	</div>
		                        	<div>
			                        	<a href="{{ route('users.edit', $u->id) }}" class="btn btn-flat btn-link btn-xs">Ubah</a>
			                        	<button type="button" class="btn btn-flat btn-link-danger btn-xs" data-toggle="modal" data-target="#deleteuser-{{ $u->id }}-modal">Hapus</button>
		                        		<div class="modal" id="deleteuser-{{ $u->id }}-modal">
		                        			<div class="modal-dialog">
		                        				<div class="modal-content">
		                        					<div class="modal-header">
		                        						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		                        						<h4 class="modal-title">Hapus {{ $u->fullName }}</h4>
	                        						</div>
	                        						<div class="modal-body">
	                        							<p>Anda yakin akan menghapus {{ $u->fullName }}?</p>
	                        						</div>
	                        						<div class="modal-footer">
	                        							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
	                        							{!! Form::open(['route' => ['users.destroy', $u->id],'method' => 'delete', 'class' => 'form-delete-inline']) !!}
	                        								{!! Form::submit('Hapus', ['class'=>'btn btn-danger btn-flat']) !!}
	                        							{!! Form::close() !!}
	                    							</div>
	                							</div>
	            							</div>
	        							</div>
		                        	</div>
		                        </td>
		                        <td>{{ $u->email }}</td>
		                        <td>{{ $u->status }}</td>
		                    </tr>
	                    @endforeach
	                </tbody>
	                <tfoot>
						<tr>
							<th><input type="checkbox"></input></th>
							<th>Nama</th>
							<th>Email</th>
							<th>Status</th>
						</tr>
					</tfoot>
				</table>
				<div class="pull-right">
					{!! $users->appends($querystring)->links() !!}
				</div>
			</div>
		</div>
	</div>
</div><!-- /.row -->
@endsection

@section('footer_scripts')
@endsection