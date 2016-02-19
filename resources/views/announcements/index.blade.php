@extends('home')

@section('header_scripts')
@endsection

@section('page_title')
	Pengumuman
@endsection

@section('page_description')
    <a href="{{ url('/announcements/create') }}" class="btn btn-flat btn-info btn-xs"><i class="fa fa-plus"></i> Tambah baru</a>
@endsection

@section('content')
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
							<th>Urgensi</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($announcements as $announcement)
						<tr>
							<td><input type="checkbox"></input></td>
	                        <td>{{ $announcement->title }}</td>
	                        <td>{{ $announcement->status }}</td>
	                        <td>
	                        	<a href="" class="btn btn-flat btn-info btn-xs">Ubah</a>
	                        	<a href="" class="btn btn-flat btn-danger btn-xs">Hapus</a>
                        	</td>
	                    </tr>
	                    @endforeach
	                </tbody>
	                <tfoot>
						<tr>
							<th><input type="checkbox"></input></th>
							<th>Judul</th>
							<th>Urgensi</th>
							<th>Action</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div><!-- /.row -->
@endsection

@section('footer_scripts')
@endsection