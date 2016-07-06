@extends('user.content')

@section('subcontent')
	<div class="panel panel-default new">
		<header class="classroom-header panel-heading">
			<h1 class="panel-title">Ingin mulai diskusi?</h1>
		</header>
		@include('user.global._tabs')
	</div>

	<ul class="nav nav-tabs feeds-tab-nav" role="tablist">
		<li role="presentation" class="active">
			<a href="#discussion-feeds" aria-controls="settings" role="tab" data-toggle="tab">Diskusi</a>
		</li>
		<li role="presentation">
			<a href="#activities-feeds" aria-controls="settings" role="tab" data-toggle="tab">Aktifitas</a>
		</li>
	</ul>

	<div class="tab-content feeds">
		<div role="tabpanel" class="tab-pane active" id="discussion-feeds">
			@forelse($discussions as $discuss)
				<div class="cpost-entry panel panel-default">
					<div class="panel-heading">
						<div class="media">
							<div class="media-left">
								<a href="#">
									<img class="media-object" src="{{ $discuss->user->picture_sm }}" alt="{{ $discuss->user->fullname }}">
								</a>
							</div>
							<div class="media-body">
								@can('delete-discussion', $discuss)
								<div class="pull-right">
									<div class="dropdown delete-post">
										<button class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="fa fa-angle-down"></i>
										</button>
										<ul class="dropdown-menu">
											<li>
												{!! Form::open(['route' => ['discuss.destroy', $discuss->id], 'method' => 'delete', 'class' => 'form-delete-inline']) !!}
													{!! Form::hidden('classroom', $discuss->classroom_id) !!}
													{!! Form::submit('Hapus', ['class'=>'btn btn-link btn-sm']) !!}
												{!! Form::close() !!}
											</li>
										</ul>
									</div>
								</div>
								@endcan

								<h4 class="media-heading">{{ $discuss->user->fullname }}</h4>
								<p><small>{{ $discuss->human_time }}</small></p>
								<p class="text-small">{{ $discuss->content }}</p>
							</div>
						</div>
					</div>
					<ul class="list-group">
						@if($discuss->comments->count() > 5)
						<li class="list-group-item text-center"><a href="{{ route('classrooms.discussiondetail', [$discuss->classroom_id, $discuss]) }}" class="btn btn-link btn-sm">Lihat {{ $discuss->comments->count() - 5 }} komentar sebelumnya...</a></li>
						@endif
						@foreach($discuss->paginate_comments as $comment)
							<li class="list-group-item">
								<ul class="media-list comment">

										<li class="media text-small">
											<div class="media-left">
												<a href="#">
													<img class="media-object" src="{{ $comment->user->picture_sm }}" alt="{{ $comment->user->fullname }}">
												</a>
											</div>
											<div class="media-body">
												<h4 class="media-heading">{{ $comment->user->fullname }}</h4>
												<p><small>{{ $comment->human_time }}</small></p>
												<p>{{ $comment->content }}</p>
											</div>
										</li>

								</ul>
							</li>
						@endforeach
					</ul>

					<div class="reply panel-footer">
						<div class="media text-small">
							<div class="media-left">
								<a href="">
									<img class="media-object" src="{{ $lms['profile']->picture_sm }}">
								</a>
							</div>
							<div class="media-body">
								{!! Form::open(['route' => 'discuss.store']) !!}
									{!! Form::hidden('classroom_id', $discuss->classroom_id) !!}
									{!! Form::hidden('parent_id', $discuss->id) !!}
									{!! Form::hidden('user_id', $lms['profile']->id) !!}
									<div class="form-group {{ $errors->has('response') ? 'has-error' : '' }}">
										{!! Form::text('content', null, ['class' => 'form-control', 'placeholder' => 'Balas...', 'autocomplete' => 'off']) !!}
										{!! $errors->first('content', '<p class="help-block">:message</p>') !!}
									</div>
								{!! Form::close() !!}
							</div>
						</div>
					</div>
				</div>
			@empty
				<h3 class="text-center no-content">Tidak ada diskusi.</h3>
			@endforelse	
			<div class="text-right"> 
				{{ $discussions->links() }}
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="activities-feeds">
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
		</div>
	</div>
@endsection