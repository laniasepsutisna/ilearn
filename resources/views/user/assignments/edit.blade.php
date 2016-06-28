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
						<h2 class="panel-title text-bold">Edit Tugas</h2>
					</header>
					<div class="panel-body">
						{!! Form::model($assignment, ['route' => ['assignments.update', $assignment], 'method' =>'put', 'role' => 'form', 'files' => true]) !!}
							@include('user.assignments._form', ['model' => $assignment])
						{!! Form::close() !!}
					</div>
				</div>
				<div class="profile-form panel panel-default">
					<header class="panel-heading">
						<h2 class="panel-title text-bold">Bagikan ke Tiap Kelas</h2>
					</header>
					<div class="panel-body">
						<div class="share-to">					
							<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#assignmentsModal"><i class="fa fa-share-alt"></i> Bagikan</button>
						</div>
						<table class="table table-stripped">
							<thead>
								<tr>
									<th>Nama Kelas</th>
									<th>Deadline</th>
									<th>Batal</th>
								</tr>
							</thead>
							<tbody>							
								@forelse($attached as $classroom_id => $attach)
									<tr>
										<td>{{ $attach['classname'] }}</td>
										<td>{{ formatDate($attach['deadline']) }}</td>
										<td>
											{!! Form::open(['route' => 'assignments.detach']) !!}
												{!! Form::hidden('classroom_id', $classroom_id) !!}
												{!! Form::hidden('assignment_id', $assignment->id) !!}
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
									<th>Deadline</th>
									<th>Batal</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="assignmentsModal" tabindex="-1" role="dialog" aria-labelledby="shareAssignment">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="shareAssignment">Bagikan tugas ini</h4>
				</div>
				{!! Form::open(['route' => ['assignments.attach'], 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal']) !!}
					<div class="modal-body clearfix">
						<div class="col-md-12">
							{!! Form::hidden('assignment_id', $assignment->id) !!}
							<div class="form-group {{ $errors->has('classroom_id') ? 'has-error' : '' }}"> 
							{!! Form::select('classroom_id', $lms['profile']->teacherclassrooms()->whereNotIn('id', $ids)->get()->pluck('classname', 'id'), null, ['class' => 'select2 form-control', 'placeholder' => 'Pilih kelas...'])  !!}
							{!! $errors->first('classroom_id', '<p class="help-block">:message</p>') !!}
							</div>
							<div class="form-group {{ $errors->has('deadline') ? 'has-error' : '' }}"> 
							{!! Form::text('deadline', null, ['class' => 'form-control datepicker', 'placeholder' => 'Deadline']) !!}
							{!! $errors->first('deadline', '<p class="help-block">:message</p>') !!}
							</div>
						</div>
					</div>
					<div class="modal-footer">
						{!! Form::button('Batal', ['class' => 'btn btn-link', 'data-dismiss' => 'modal']) !!}
						{!! Form::button('<i class="fa fa-share-alt"></i> Bagikan Tugas', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection