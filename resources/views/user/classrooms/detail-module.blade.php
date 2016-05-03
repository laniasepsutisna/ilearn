@extends('user.classrooms.classroom')

@section('classroom_content')
	<div class="panel panel-default panel-module">
		<header class="panel-heading clearfix">
			<h2 class="panel-title pull-left text-bold">{{ $module->name }}</h2>
			<div class="pull-right"><a class="btn-link btn-sm" href="{{ route('classrooms.coursedetail', [$classroom->id, $module->course->id]) }}">{{ substr($module->course->name, 0, 40) }} >></a></div>
		</header>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-12">
					@if($module->media)
						<div class="embed-responsive embed-responsive-16by9">
							{!! $module->media !!}
						</div>
					@endif

					@if($module->file)
						<div class="embed-responsive embed-responsive-16by9">
							<iframe src="{{ url('ViewerJS/#../uploads/courses/' . $module->file) }}" width='400' height='300' allowfullscreen webkitallowfullscreen></iframe>
						</div>
					@endif
				</div>
				<div class="col-xs-12 module-description">{!! $module->description !!}</div>
			</div>
		</div>
	</div>
@endsection
