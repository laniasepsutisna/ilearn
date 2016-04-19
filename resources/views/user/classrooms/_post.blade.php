@forelse($classroom->paginate_discussions as $discuss)
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
										{!! Form::submit('Hapus', ['class'=>'btn btn-link btn-sm']) !!}
									{!! Form::close() !!}
								</li>
							</ul>
						</div>
					</div>
					@endcan

					<h4 class="media-heading">{{ $discuss->user->fullname }}</h4>
					<p>{{ $discuss->content }}</p>
					<p><small>{{ $discuss->human_time }}</small></p>
				</div>
			</div>
		</div>
		
		@foreach($discuss->comments as $comment)
			<div class="panel-body">
				<ul class="media-list">

						<li class="media text-small">
							<div class="media-left">
								<a href="#">
									<img class="media-object" src="{{ $comment->user->picture_sm }}" alt="{{ $comment->user->fullname }}">
								</a>
							</div>
							<div class="media-body">
								<h4 class="media-heading">{{ $comment->user->fullname }}</h4>
								<p>{{ $comment->content }}</p>
								<p><small>{{ $comment->human_time }}</small></p>
							</div>
						</li>

				</ul>
			</div>
		@endforeach

		<div class="reply panel-footer">
			<div class="media text-small">
				<div class="media-left">
					<a href="">
						<img src="{{ $lms['profile']->picture_sm }}">
					</a>
				</div>
				<div class="media-body">
					{!! Form::open(['route' => 'discuss.store']) !!}
						{!! Form::hidden('classroom_id', $classroom->id) !!}
						{!! Form::hidden('parent_id', $discuss->id) !!}
						{!! Form::hidden('user_id', $lms['profile']->id) !!}
						<div class="form-group {{ $errors->has('response') ? 'has-error' : '' }}">
							{!! Form::text('content', null, ['class' => 'form-control', 'placeholder' => 'Balas...']) !!}
							{!! $errors->first('content', '<p class="help-block">:message</p>') !!}
						</div>
						<div class="text-right"> 
							{!! Form::submit('Balas', ['class'=>'btn btn-flat btn-success']) !!}
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@empty
	<h4>Diskusi masih kosong. Mulai diskusi?</h4>
@endforelse
<div class="text-right"> 
	{{ $classroom->paginate_discussions->links() }}
</div>