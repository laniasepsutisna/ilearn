@extends('user.classrooms.classroom')

@section('classroom_content')
	<div class="panel panel-default panel-module">
		<header class="panel-heading clearfix">
			<h2 class="panel-title text-bold">{{ $quiz->title }}</h2>
		</header>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-12">
				</div>
				<div class="col-xs-12 quiz-description">{{ $quiz->time_limit }}</div>
			</div>
		</div>
	</div>
@endsection
