@extends('user.content')

@section('subcontent')
	<div class="classroom-wrapper">
		<header class="classroom-header entry">
			<h1>{{ $classroom->classname }}</h1>
			<p>
				<span><strong>Guru:</strong> {{ $classroom->teacher_name }}</span> &middot;
				<span><strong>Kelas:</strong> {{ $classroom->grade }}</span> &middot; 
				@can('manage')
					<span class="pull-right"><button><i class="fa fa-cog"></i></button></span>
				@endcan
			</p>
			@include('user.classrooms._tabs')
		</header>

		@include('user.classrooms._post')
	</div>
@endsection