@extends('user.app')

@section('content')	
	<div class="container libraries">
		<div class="row">
			<div class="col-sm-4 col-md-2 hidden-xs">
				@include('user.global.sidebars._sidebar-left')
			</div>
			<div class="col-md-10">		
				<div class="profile-form panel panel-default">
					<header class="panel-heading">
						<h2 class="panel-title text-bold">Edit Materi</h2>
					</header>
					<div class="panel-body">
						{!! Form::model($course, ['route' => ['courses.update', $course], 'method' =>'put', 'role' => 'form', 'files' => true]) !!}
							@include('user.courses._form', ['model' => $course])
						{!! Form::close() !!}
					</div>
				</div>

				<div class="profile-form panel panel-default">
					<header class="panel-heading">
						<h2 class="panel-title text-bold">Modul</h2>
					</header>
					<div class="panel-body">
						<div class="share-to">					
							<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#moduleModal"><i class="fa fa-plus"></i> Modul</button>
						</div>						
						<ul class="list-group module-list">
							@forelse($course->modules as $no => $module)
								<li class="list-group-item">
									@if($module->media) 
										<i class="fa fa-play"></i> 
									@else
										<i class="fa fa-book"></i> 
									@endif
									{{ $no + 1 }}. {{ $module->name }}
									<span class="pull-right">
										<a href="{{ route('modules.edit', $module->id) }}" class="btn-link btn-sm">Edit</a>
										{!! Form::open(['route' => ['modules.destroy', $module->id], 'method' => 'delete', 'class' => 'element-inline']) !!}
											{!! Form::button('Delete', ['class' => 'btn-link btn-link-danger btn-sm warning-delete', 'type' => 'submit', 'data-title' => $module->name]) !!}
										{!! Form::close() !!}
									</span>
								</li>
							@empty
								<li class="list-group-item text-center">Belum ada modul untuk materi ini. <a href="#" class="btn-link" data-toggle="modal" data-target="#moduleModal">Tambahkan</a></li>
							@endforelse
						</ul>
					</div>
				</div>

				<div class="profile-form panel panel-default">
					<header class="panel-heading">
						<h2 class="panel-title text-bold">Bagikan ke Tiap Kelas</h2>
					</header>
					<div class="panel-body">
						<div class="share-to">					
							<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#courseModal"><i class="fa fa-share-alt"></i> Bagikan</button>
						</div>
						<table class="table table-stripped">
							<thead>
								<tr>
									<th>Nama Kelas</th>
									<th>Batal</th>
								</tr>
							</thead>
							<tbody>							
								@forelse($attached as $classroom_id => $attach)
									<tr>
										<td>{{ $attach['classname'] }}</td>
										<td>
											{!! Form::open(['route' => 'courses.detach']) !!}
												{!! Form::hidden('course_id', $course->id) !!}
												{!! Form::hidden('classroom_id', $classroom_id) !!}
												{!! Form::submit('Batal', ['class' => 'btn btn-danger btn-sm']) !!}
											{!! Form::close() !!}
										</td>
									</tr>
								@empty
									<tr>
										<td colspan="3" class="text-center">Belum pernah dibagikan.</td>
									</tr>
								@endforelse
							</tbody>
							<tfoot>
								<tr>
									<th>Nama Kelas</th>
									<th>Batal</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="moduleModal" tabindex="-1" role="dialog" aria-labelledby="newModule">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Tambahkan Modul</h4>
				</div>
				{!! Form::open(['route' => ['modules.store'], 'method' => 'post', 'files' => true]) !!}
					<div class="modal-body clearfix">
						<div class="col-md-12">
							@include('user.courses._form-module')
						</div>
					</div>
					<div class="modal-footer text-right">
						{!! Form::button('Tambahkan', ['class'=>'btn btn-flat btn-success', 'type' => 'submit']) !!}
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>

	<div class="modal fade" id="courseModal" tabindex="-1" role="dialog" aria-labelledby="shareCourse">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Bagikan Materi ini</h4>
				</div>
				{!! Form::open(['route' => ['courses.attach'], 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal']) !!}
					<div class="modal-body clearfix">
						<div class="col-md-12">
							{!! Form::hidden('course_id', $course->id) !!}
							<div class="form-group {{ $errors->has('classrooms') ? 'has-error' : '' }}"> 
							{!! Form::select('classrooms[]', App\Models\Classroom::whereNotIn('id', $ids)->get()->pluck('classname', 'id'), null, ['class' => 'select2 form-control', 'multiple'])  !!}
							{!! $errors->first('classrooms', '<p class="help-block">:message</p>') !!}
							</div>
						</div>
					</div>
					<div class="modal-footer">
						{!! Form::button('Batal', ['class' => 'btn btn-link', 'data-dismiss' => 'modal']) !!}
						{!! Form::button('<i class="fa fa-share-alt"></i> Bagikan Materi', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection