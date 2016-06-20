@extends('user.content')

@section('subcontent')
	<div class="panel panel-default new">
		<header class="classroom-header panel-heading">
			<h1 class="panel-title">Ingin mulai diskusi?</h1>
		</header>
		@include('user.global._tabs')
	</div>

	@forelse($lms['activities'] as $activity)
		<div class="panel panel-default">
			<ul class="list-group">
				<li class="list-group-item">
					<p>
						<a href="{{ $activity->teacher_id == $lms['profile']->id ? route( 'home.profile') : route('home.friend', $activity->teacher->username) }}"><strong>{{ $activity->teacher_id == $lms['profile']->id ? 'Saya' : $activity->teacher->fullname }}</strong></a>
					</p>
					<p>{{ $activity->action }} 
						@can('manage')
							{{ $activity->classroom->classname }}
						@else
							<a href="{{ route($activity->route, [$activity->classroom->id, $activity->detail]) }}">{{ $activity->classroom->classname }}</a>.
						@endcan
					</p>
					<small>{{ formatDate($activity->created_at) }}</small>
				</li>
			</ul>
		</div>
		<div class="text-right"> 
			{{ $lms['activities']->links() }}
		</div>
	@empty
		<h3 class="text-center no-content">Tidak ada aktifitas.</h3>
	@endforelse
@endsection