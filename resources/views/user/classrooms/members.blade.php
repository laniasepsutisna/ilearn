@extends('user.classrooms.classroom')
@section('classroom_content')
	<div class="panel panel-default">
		<header class="panel-heading">
			<h2 class="panel-title">Member</h2>
		</header>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-3 col-md-2">
					<div class="thumbnail" data-toggle="tooltip" data-placement="bottom" title="{{ $classroom->teacher->fullname }}">
						<a href="{{ route('home.friend', $classroom->teacher->username) }}"><img src="{{ $classroom->teacher->picture_md }}" alt="{{ $classroom->teacher->fullname }}"></a>
					</div>
				</div>
				@foreach($classroom->students as $student)
					<div class="col-xs-3 col-md-2">
						<div class="thumbnail" data-toggle="tooltip" data-placement="bottom" title="{{ $student->fullname }}">
							<a href="{{ route('home.friend', $student->username) }}"><img src="{{ $student->picture_md }}" alt="{{ $student->fullname }}"></a>
						</div>
						@can('manage')
						<div class="text-center toogleStatus">
							<input type="checkbox" class="studentStatus" value="{{ $student->id }}" {{ $student->status !== 'active' ?: 'checked' }} data-toggle="toggle" data-onstyle="success" data-style="android" data-size="mini" data-on="Active" data-off="Banned">
						</div>
						@endcan
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endsection
