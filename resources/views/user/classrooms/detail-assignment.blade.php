@extends('user.classrooms.classroom')

@section('classroom_content')
	<div class="panel panel-default">
		<header class="panel-heading">
			<h2 class="panel-title text-bold">{{ $assignment->title }}</h2>
		</header>
		<ul class="list-group">
			<li class="list-group-item">{!! $assignment->content !!}</li>
			
			<li class="list-group-item"><span class="text-small"><strong>Deadline:</strong> {{ $assignment->deadline->toFormattedDateString() }}</span></li>
			@if($assignment->file)
				<li class="list-group-item"><span class="attached"><i class="fa fa-paperclip"></i></span><a href="{{ route('classrooms.download', $assignment->file) }}">{{ $assignment->file }}</a></li>
			@endif
		</ul>		
	</div>
	@can('manage')
	
	@else
		@if(! $deadline)
			@if(! $submit)
				<div class="panel panel-default">
					<header class="panel-heading">
						<h2 class="panel-title text-bold">Submit Tugas</h2>
					</header>
					<ul class="list-group">
						<li class="list-group-item">				
							{!! Form::open(['route' => ['submissions.store', $assignment->id], 'method' => 'post']) !!}
								<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
									{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Judul...']) !!}
									{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
								</div>
								<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
									{!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Konten...']) !!}
									{!! $errors->first('content', '<p class="help-block">:message</p>') !!}
								</div>
								<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
									{!! Form::file('file') !!}
									{!! $errors->first('file', '<p class="help-block">:message</p>') !!}
								</div>
								<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
									{!! Form::submit('Kumpul', ['class' => 'btn btn-primary']) !!}
								</div>
							{!! Form::close() !!}
						</li>			
					</ul>
				</div>
				<div class="panel panel-default">					
					<div class="panel-heading">
						<h4>Tugas terkumpul</h4>
					</div>
					<footer class="panel-body">						
						<ul class="list-group">								
							@foreach($assignment->submissions as $user)
								<li class="list-group-item">{{ $user->fullname }}</li>
							@endforeach
						</ul>
					</footer>
				</div>
			@else
				<h4 class="text-center no-content">Anda sudah menyelesaikan tugas ini.</h4>
			@endif
		@else
			<h4 class="text-center no-content">Tugas sudah mencapai deadline.</h4>
		@endif
	@endcan

@endsection