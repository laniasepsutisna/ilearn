@extends('user.app')

@section('content')	
	<div class="container libraries">
		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-default profile-menu">
					<header class="panel-heading">
						<h2 class="panel-title">Perpustakaan</h2>
					</header>
					<div class="panel-body">
						<ul class="nav nav-pills nav-stacked">
							<li class="{{ set_active('assignments.index') }}"><a href="{{ route('assignments.index') }}">Tugas</a></li>
							<li class="{{ set_active('quizes.index') }}"><a href="{{ route('quizes.index') }}">Quiz</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="panel panel-default">
					<header class="panel-heading">
						<h2 class="panel-title">{{ $page_title }}</h2>
					</header>
					<div class="panel-body">
						<div class="pull-left">
							<a href="{{ route('assignments.create') }}" class="btn btn-success">Buat baru</a>
						</div>
						<div class="pull-right nomargin-paginator">
							{{ $assignments->links() }}
						</div>
					</div>
				</div>

				@forelse($assignments as $assignment)
					<div class="panel panel-default">
						<header class="panel-heading">
							<h2 class="panel-title">{{ $assignment->title }}</h2>
						</header>
						<ul class="list-group">
							<li class="list-group-item">{!! $assignment->content !!}</li>
							@if($assignment->file)
								<li class="list-group-item">{{ $assignment->file }}</li>
							@endif
						</ul>
						<div class="panel-footer text-right">
							<a href="{{ route('assignments.edit', $assignment->id) }}" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Edit</a>
							<button class="btn btn-primary btn-sm shareAssignments" data-toggle="modal" data-target="#assignmentsModal" data-assg="{{ $assignment->id }}"><i class="fa fa-share-alt"></i> Bagikan</button>
							{!! Form::open(['route' => ['assignments.destroy', $assignment->id], 'method' => 'delete', 'class' => 'element-inline']) !!}
								{!! Form::button('<i class="fa fa-trash"></i> Hapus', ['class' => 'btn btn-danger btn-sm warning-delete', 'type' => 'submit', 'data-title' => $assignment->title]) !!}
							{!! Form::close() !!}
						</div>
					</div>
				@empty
					<div class="panel panel-default">
						<div class="panel-body text-center">
							Tidak ada tugas sama sekali. <a href="{{ route('assignments.create') }}" class="btn btn-link">Buat tugas sekarang.</a>
						</div>
					</div>
				@endforelse
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
					<div class="modal-body">
						<div class="col-md-12">
							{!! Form::hidden('assignment_id', null, ['id' => 'chgAssignment']) !!}
							<div class="form-group {{ $errors->has('classrooms') ? 'has-error' : '' }}"> 
							{!! Form::select('classrooms[]', $lms['classrooms']->pluck('classname', 'id'), null, ['class' => 'select2 form-control', 'multiple'])  !!}
							{!! $errors->first('classrooms', '<p class="help-block">:message</p>') !!}
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