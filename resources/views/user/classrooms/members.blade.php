@extends('user.classrooms.classroom')
@section('classroom_content')
	<div class="panel panel-default">
		<header class="panel-heading">
			<h2 class="panel-title">Member</h2>
		</header>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-3 col-md-2">
					<div class="thumbnail">
						<img src="{{ $classroom->teacher->picture_md }}" alt="{{ $classroom->teacher->fullname }}">
						<div class="caption">
							<small>Guru</small>
						</div>
					</div>
				</div>
				@foreach($classroom->students as $student)
					<div class="col-sm-3 col-md-2">
						<div class="thumbnail">
							<img src="{{ $student->picture_md }}" alt="{{ $student->fullname }}">
							<div class="caption">
								<small>Siswa</small>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endsection
