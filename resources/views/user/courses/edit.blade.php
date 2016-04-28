@extends('user.app')

@section('content')	
	<div class="container libraries">
		<div class="row">
			<div class="col-md-3">
				<div class="profile-menu panel panel-default">
					<header class="panel-heading">
						<h2 class="panel-title">Perpustakaan</h2>
					</header>
					<div class="panel-body">
						<ul class="nav nav-pills nav-stacked">
							<li class="{{ set_active('assignments.index') }}"><a href="{{ route('assignments.index') }}">Tugas</a></li>
							<li class="{{ set_active('courses.index') }}"><a href="{{ route('courses.index') }}">Materi</a></li>
							<li class="{{ set_active('quizes.index') }}"><a href="{{ route('quizes.index') }}">Quiz</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9">			
				<div class="profile-form panel panel-default">
					<header class="panel-heading">
						<h2 class="panel-title">{{ $page_title }}</h2>
					</header>
					<div class="panel-body">
						{!! Form::model($course, ['route' => ['courses.update', $course], 'method' =>'put', 'role' => 'form', 'files' => true]) !!}
							@include('user.courses._form', ['model' => $course])
						{!! Form::close() !!}
					</div>
				</div>

				<div class="profile-form panel panel-default">
					<header class="panel-heading">
						<h2 class="panel-title">Bagikan ke Tiap Kelas</h2>
					</header>
					<div class="panel-body">
						<div class="share-to">					
							<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#courseModal" data-assg="{{ $course->id }}"><i class="fa fa-share-alt"></i> Bagikan</button>
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
											{!! Form::open(['route' => 'assignments.detach']) !!}
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

	<div class="modal fade" id="courseModal" tabindex="-1" role="dialog" aria-labelledby="shareCourse">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Bagikan Materi ini</h4>
				</div>
				{!! Form::open(['route' => ['courses.attach'], 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal']) !!}
					<div class="modal-body">
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
						{!! Form::button('<i class="fa fa-share-alt"></i> Bagikan Tugas', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection