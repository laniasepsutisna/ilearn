@extends('user.content')

@section('subcontent')
	<h3 class="timeline">Timeline</h3>
	@forelse($lms['activities'] as $activity)
		<div class="panel panel-default">
			<ul class="list-group">
				<li class="list-group-item">
					<a href="{{ $activity->teacher_id == $lms['profile']->id ? route( 'home.profile') : route('home.friend', $activity->teacher->username) }}"><strong>{{ $activity->teacher_id == $lms['profile']->id ? 'Saya' : $activity->teacher->fullname }}</strong></a>
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
	@empty
		<h3 class="text-center no-content">Tidak ada aktifitas.</h3>
	@endforelse
@endsection