@extends('admin.app')

@section('content')
<div class="row">
	<div class="col-md-4">
		@include('admin.home._box-classrooms', ['classrooms' => $classrooms])	
		@include('admin.home._box-users', ['users' => $users])
	</div>
	<div class="col-md-4">	
		@include('admin.home._box-majors', ['majors' => $majors])
		@include('admin.home._box-announcements', ['announcements' => $announcements])
	</div>
	<div class="col-md-4">
		@include('admin.home._box-subjects', ['subjects' => $subjects])	
	</div>
</div>
@endsection