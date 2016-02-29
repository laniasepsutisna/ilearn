@extends('home')

@section('header_scripts')
<link href="{{ asset('/css/sweetalert.css') }}" rel="stylesheet">
@endsection

@section('page_title')
	Pengumuman
@endsection

@section('page_description')
    <a href="{{ route('announcements.create') }}" class="btn btn-flat btn-info btn-xs"><i class="fa fa-plus"></i> Tambah Baru</a>
@endsection

@section('content')

<div class="row">
	<div class="pull-right col-xs-6 col-sm-4 col-md-3">

		{!! Form::open(['method' => 'get']) !!}
			<div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-search"></i></span>
					{!! Form::text( 'q', isset($q) ? $q : null, ['class' => 'form-control', 'placeholder' => 'Cari pengumuman...']) !!}
				</div>
			</div>
		{!! Form::close() !!}
		
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Tabel Pengumuman</h3>
			</div>
			<div class="box-body">
				<table id="announcement-datatable" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th><input type="checkbox"></input></th>
							<th>Judul</th>
							<th>Konten</th>
							<th>Urgensi</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($announcements as $a)
						<tr>
							<td><input type="checkbox"></input></td>
	                        <td>
	                        	<div>
	                        		<a href="{{ route('announcements.edit', $a->id) }}">{{ $a->title }}</a>
	                        	</div>
	                        	<div>
		                        	<a href="{{ route('announcements.edit', $a->id) }}" class="btn btn-flat btn-link btn-xs">Ubah</a>
        							{!! Form::open(['route' => ['announcements.destroy', $a->id],'method' => 'delete', 'class' => 'form-delete-inline']) !!}
        								{!! Form::submit('Hapus', ['class'=>'btn btn-flat btn-link btn-link-danger btn-xs warning-delete', 'data-title' => $a->title]) !!}
        							{!! Form::close() !!}
	                        	</div>
	                        </td>
	                        <td>{!! substr( $a->content, 0, 100 ) !!}</td>
	                        <td>{{ $a->status }}</td>
	                    </tr>
	                    @endforeach
	                </tbody>
	                <tfoot>
						<tr>
							<th><input type="checkbox"></input></th>
							<th>Judul</th>
							<th>Konten</th>
							<th>Urgensi</th>
						</tr>
					</tfoot>
				</table>
				<div class="pull-right"> 
					{!! $announcements->links() !!}
				</div>
			</div>
		</div>
	</div>
</div><!-- /.row -->
@endsection

@section('footer_scripts')
<script src="{{ asset ('/js/admin.js') }}" type="text/javascript"></script>
@endsection