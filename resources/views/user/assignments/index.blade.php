@extends('user.content')

@section('subcontent')
	<h3>{{ $assignment->title }}</h3>
	<p>{{ $assignment->content }}</p>
	<strong>Deadline: {{ $assignment->deadline->toFormattedDateString() }}</strong>

	<h3>Yang sudah ngumpul</h3>
	@foreach($assignment->submissions as $sub)
		<p>{{ $sub->fullname }}</p>
	@endforeach

	<h3>Form</h3>
	@if(! $deadline)
		@if(! $submit)
			{!! Form::open(['route' => ['createsubmission', $assignment->id], 'method' => 'post']) !!}
				{!! Form::text('title') !!}
				{!! Form::text('file') !!}
				{!! Form::textarea('content') !!}
				{!! Form::submit('Kumpul') !!}
			{!! Form::close() !!}
		@endif
	@endif

@endsection