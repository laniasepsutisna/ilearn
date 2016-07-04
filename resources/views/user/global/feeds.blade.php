@extends('user.content')

@section('subcontent')
	<div class="panel panel-default new">
		<header class="classroom-header panel-heading">
			<h1 class="panel-title">Ingin mulai diskusi?</h1>
		</header>
		@include('user.global._tabs')
	</div>
	@forelse($activities as $activity)
		<div class="panel panel-default feeds">
			<div class="panel-body">
				<p>
					<a href="{{ $activity->teacher_id == $lms['profile']->id ? route( 'home.profile') : route('home.friend', $activity->teacher->username) }}"><strong>{{ $activity->teacher->fullname }}</strong></a>
				</p>
				<p class="activity">{{ $activity->action }} 
					@can('manage')
						{{ $activity->classroom->classname }}
					@else
						<a href="{{ route($activity->route, [$activity->classroom->id, $activity->detail]) }}">{{ $activity->classroom->classname }}</a>.
					@endcan
				</p>
				<small>{{ formatDate($activity->created_at) }}</small>
			</div>
		</div>
	@empty
		<h3 class="text-center no-content">Tidak ada aktifitas.</h3>
	@endforelse	
	<div class="text-right"> 
		{{ $activities->links() }}
	</div>
@endsection