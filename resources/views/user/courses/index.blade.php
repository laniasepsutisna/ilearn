@extends('user.app')

@section('content')	
	<div class="container libraries">
		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-default profile-menu">
					<header class="panel-heading">
						<h2 class="panel-title">Perpustakaan</h2>
					</header>
					<div class="panel-body">
						<ul class="nav nav-pills nav-stacked">
							<li class="{{ set_active('assignments.index') }}"><a href="{{ route('assignments.index') }}">Tugas</a></li>
							<li class="{{ set_active('courses.index') }}"><a href="{{ route('courses.index') }}">Materi</a></li>
							<li class="{{ set_active('quizes.index') }}"><a href="{{ route('quizes.index') }}">Quiz</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="panel panel-default">
					<header class="panel-heading">
						<h2 class="panel-title">{{ $page_title }}</h2>
					</header>
					<div class="panel-body">
						<div class="pull-left">
							<a href="{{ route('courses.create') }}" class="btn btn-success">Buat baru</a>
						</div>
						<div class="pull-right nomargin-paginator">
							{{ $courses->links() }}
						</div>
					</div>
				</div>

				@forelse($courses as $course)
					<div class="panel panel-default">
						<header class="panel-heading">
							<h2 class="panel-title">{{ $course->title }}</h2>
						</header>
						<ul class="list-group">
							<li class="list-group-item">{!! $course->content !!}</li>
							@if($course->file)
								<li class="list-group-item"><i class="fa fa-paperclip"></i> {{ $course->file }}</li>
							@endif
						</ul>
						<div class="panel-footer text-right">
							<a href="{{ route('courses.edit', $course->id) }}" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Edit</a>
							{!! Form::open(['route' => ['courses.destroy', $course->id], 'method' => 'delete', 'class' => 'element-inline']) !!}
								{!! Form::button('<i class="fa fa-trash"></i> Hapus', ['class' => 'btn btn-danger btn-sm warning-delete', 'type' => 'submit', 'data-title' => $course->title]) !!}
							{!! Form::close() !!}
						</div>
					</div>
				@empty
					<div class="panel panel-default">
						<div class="panel-body text-center">
							Tidak ada materi sama sekali. <a href="{{ route('courses.create') }}" class="btn btn-link">Buat materi baru sekarang.</a>
						</div>
					</div>
				@endforelse
			</div>
		</div>
	</div>

@endsection