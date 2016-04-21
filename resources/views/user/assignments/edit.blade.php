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
						{!! Form::model($assignment, ['route' => ['assignments.update', $assignment], 'method' =>'patch', 'role' => 'form']) !!}
							@include('user.assignments._form')
						{!! Form::close() !!}
					</div>
				</div>

				<div class="profile-form panel panel-default">
					<header class="panel-heading">
						<h2 class="panel-title">Dibagikan</h2>
					</header>
					<div class="panel-body">
						<table class="table table-stripped">
							<thead>
								<tr>
									<th>Nama Kelas</th>
									<th>Deadline</th>
									<th>Batal</th>
								</tr>
							</thead>
							<tbody>							
								@forelse($attached as $id => $attach)
									<tr>
										<td>{{$attach['classname'] }}</td>
										<td>{{$attach['deadline'] }}</td>
										<td>
											{!! Form::open(['route' => ['assignments.detach', $id], 'class' => 'inline-form', 'method' => 'delete']) !!}
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
@endsection