@extends('user.app')

@section('content')
<div class="container content">
	<div class="row">
		<div class="col-sm-8 col-md-9">
			<div class="text-right">
				<a class="btn btn-link btn-sm" href="{{ route('home.index') }}"><i class="fa fa-angle-double-right"></i> Kembali ke Beranda.</a>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title text-bold"><i class="fa fa-file"></i> {{ $page_title }}</h2>
				</div>
				<ul class="list-group">
					@foreach($assignments as $index => $assignment)
						<li class="list-group-item">
							<article class="post assignment">
								<strong>{{ $index + 1 }}. {{ $assignment->title }}</strong>
								<div>
									{!! $assignment->content !!}
									@can('manage')
										@foreach($assignment->classrooms as $classroom)
											<a class="btn btn-primary btn-sm" href="{{ route('classrooms.assignmentdetail', [$classroom->id, $assignment->id]) }}">
												<i class="fa fa-send"></i>
												{{ $classroom->classname }}
												<small>({{ formatDate($classroom->pivot->deadline) }})</small>
											</a>
										@endforeach
									@else
										<a class="btn btn-primary" href="{{ route('classrooms.assignmentdetail', [$assignment->classrooms->whereIn('id', $lms['joined_class'])->first()->id, $assignment->id]) }}">
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