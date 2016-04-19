@extends('user.content')

@section('subcontent')
	<div class="classroom-wrapper panel panel-default">
		<header class="classroom-header panel-heading">
			<h1 class="panel-title text-bold">{{ $classroom->classname }}</h1>
		</header>
		<ul class="list-group">
			<li class="list-group-item">
				<p><strong>Guru:</strong> {{ $classroom->teacher_name }}</p>
				<p><strong>Kelas:</strong> {{ $classroom->grade }}</p>
			</li>
		</ul>
		@include('user.classrooms._tabs')
	</div>
	@include('user.classrooms._post')
@endsection