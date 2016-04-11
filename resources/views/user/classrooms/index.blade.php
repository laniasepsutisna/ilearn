@extends('user.content')

@section('subcontent')
	<div class="classroom-wrapper panel panel-primary">
		<header class="classroom-header panel-heading">
			<h1 class="panel-title">{{ $classroom->classname }}</h1>
			<p>
				<span><strong>Guru:</strong> {{ $classroom->teacher_name }}</span> &middot;
				<span><strong>Kelas:</strong> {{ $classroom->grade }}</span> &middot; 
				@can('manage')
					<span class="pull-right"><button><i class="fa fa-cog"></i></button></span>
				@endcan
			</p>
		</header>
		<div class="panel-body">			
			@include('user.classrooms._tabs')
		</div>
	</div>
	@include('user.classrooms._post')
@endsection