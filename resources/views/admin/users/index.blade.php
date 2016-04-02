@extends('admin.app')

@section('page_description')
    <a href="{{ route('lms-admin.users.create') }}" class="btn btn-flat btn-info btn-xs"><i class="fa fa-plus"></i> Tambah Baru</a>
@endsection

@section('content')
<div class="row">
	<div class="pull-left col-xs-6 col-sm-8 col-md-3">
		<div class="btn-group" role="group">
			<a class="btn btn-default" href="{{ route('lms-admin.users.index') }}">All</a>
			<a class="btn btn-default" href="{{ route('lms-admin.users.index', ['type' => 'staff']) }}">Staff</a>
			<a class="btn btn-default" href="{{ route('lms-admin.users.index', ['type' => 'teacher']) }}">Guru</a>
			<a class="btn btn-default" href="{{ route('lms-admin.users.index', ['type' => 'student']) }}">Siswa</a>
		</div>
	</div>
	<div class="pull-right col-xs-6 col-sm-4 col-md-3">

		{!! Form::open(['method' => 'get']) !!}
			<div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
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
							<th>Role</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
							<tr>
								<td><input type="checkbox" name="id[]" value="{{ $user->id }}"></input></td>
		                        <td>
		                        	<div>{{ $user->fullname }}</div>
		                        	<div>
		                        		<a href="{{ route('lms-admin.users.edit', $user->id) }}" class="btn btn-flat btn-link btn-xs">Edit</a>
		                        		@if($user->username !== 'admin' || $user->username !== Auth::user()->username)
    									{!! Form::open(['route' => ['lms-admin.users.destroy', $user->id], 'method' => 'delete', 'class' => 'form-delete-inline']) !!}
        									{!! Form::submit('Hapus', ['class'=>'btn btn-flat btn-link btn-link-danger btn-xs warning-delete']) !!}
        								{!! Form::close() !!}
        								@endif
		                        	</div>
		                        </td>
		                        <td>{{ $user->email }}</td>
		                        <td>{{ $user->status }}</td>
		                        <td>{{ $user->rolename }}</td>
		                    </tr>
	                    @endforeach
	                </tbody>
	                <tfoot>
						<tr>
							<th><input type="checkbox"></input></th>
							<th>Nama</th>
							<th>Email</th>
							<th>Status</th>
							<th>Role</th>
						</tr>
					</tfoot>
				</table>
				<div class="pull-right">
				@if( $querystring !== null )
					{!! $users->appends($querystring)->links() !!}
				@else
					{!! $users->links() !!}
				@endif
				</div>
			</div>
		</div>
	</div>
</div><!-- /.row -->
@endsection