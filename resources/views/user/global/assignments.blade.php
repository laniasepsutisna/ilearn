@extends('user.app')

@section('content')
<div class="container content">
	<div class="row">
		<div class="col-sm-3 col-md-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Pemberitahuan</h2>
				</div>
				<ul class="list-group">
					<li class="list-group-item"><a class="text-small" href="{{ route('home.announcements') }}"><i class="fa fa-volume-up"></i> Pengumuman</a></li>
					<li class="list-group-item"><a class="text-small" href="{{ route('home.assignments') }}"><i class="fa fa-file"></i> Tugas</a></li>
					<li class="list-group-item"><a class="text-small" href="{{ route('home.onlines') }}"><i class="fa fa-circle"></i> Online</a></li>
				</ul>
			</div>
		</div>
		<div class="col-sm-5 col-md-7">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title text-bold"><i class="fa fa-file"></i> {{ $page_title }}</h2>
				</div>
				<ul class="list-group">
					@foreach($assignments as $index => $assignment)
						<li class="list-group-item">
							<article class="post assignment">
								<strong>{{ $index + 1 }}. {{ $assignment->title }}</strong>
								<div>{!! $assignment->content !!}</div>
								<div>
									@can('manage')
										@foreach($assignment->classrooms as $classroom)
											<a class="btn btn-primary btn-sm" href="{{ route('classrooms.assignmentdetail', [$classroom->id, $assignment->id]) }}">
												<i class="fa fa-send"></i>
												{{ $classroom->classname }}
												<small>({{ formatDate($classroom->pivot->deadline) }})</small>
											</a>
										@endforeach
									@else
										<a class="btn btn-primary" href="{{ route('classrooms.assignmentdetail', [$assignment->classrooms->whereIn('id', $lms['profile']->joinedClassrooms)->first()->id, $assignment->id]) }}">
											<i class="fa fa-send"></i>
											Kerjakan
										</a>
									@endcan
								</div>
							</article>
						</li>
					@endforeach
				</ul>
				<footer class="text-right">
					{{ $assignments->links() }}
				</footer>
			</div>
		</div>		
		<div class="col-sm-4 col-md-3 hidden-sm">
			@include( 'user.global.sidebars._sidebar-right' )
		</div>
	</div>
</div>
@endsection