@extends('user.app')

@section('content')	
	<div class="container libraries">
		<div class="row">
			<div class="col-sm-4 col-md-2 hidden-xs">
				@include('user.global.sidebars._sidebar-left')
			</div>
			<div class="col-md-10">
				<div class="panel panel-default">
					<header class="panel-heading">					
						<a href="{{ route('courses.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Materi Baru</a>
					</header>
					<div class="panel-body">
						@forelse($courses as $course)
							<div class="panel panel-primary panel-sm">
								<header class="panel-heading">
									<h2 class="panel-title text-bold">{{ $course->name }}</h2>
								</header>
								<ul class="list-group">
									<li class="list-group-item">{!! $course->description !!}</li>
								</ul>
								<div class="panel-footer text-right">
									<a href="{{ route('courses.edit', $course->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
									{!! Form::open(['route' => ['courses.destroy', $course->id], 'method' => 'delete', 'class' => 'element-inline']) !!}
										{!! Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-danger btn-sm warning-delete', 'type' => 'submit', 'data-title' => $course->name]) !!}
									{!! Form::close() !!}
								</div>
							</div>
						@empty
							<div class="panel panel-default">
								<div class="panel-body text-center">
									Tidak ada materi sama sekali. <a href="{{ route('courses.create') }}" class="btn-link">Buat materi baru sekarang.</a>
								</div>
							</div>
						@endforelse
					</div>
					<div class="panel-footer">
						<div class="pull-right nomargin-paginator">
							{{ $courses->links() }}
						</div>
					</div>
				</div>				
			</div>
		</div>
	</div>

@endsection