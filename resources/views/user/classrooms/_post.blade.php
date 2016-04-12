@forelse($classroom->paginate_discussions as $discuss)
	<div class="cpost-entry panel panel-default">
		<div class="cpost-meta panel-heading">
			<figure>
				<img src="{{ $discuss->user->picture_sm }}">
				<figcaption>
					<a href=""><strong>{{ $discuss->user->fullname }}</strong></a>
				</figcaption>
			</figure>
			@can('delete-discussion', $discuss)
			<div class="dropdown">
				<button class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu">
					<li>
						{!! Form::open(['route' => ['discuss.destroy', $discuss->id], 'method' => 'delete', 'class' => 'form-delete-inline']) !!}
							{!! Form::submit('Hapus', ['class'=>'btn btn-link']) !!}
						{!! Form::close() !!}
					</li>
				</ul>
			</div>
			@endcan
		</div>
		<div class="cpost-content panel-body">
			{{ $discuss->content }}
		</div>
		<ul class="list-group response-wrapper">
			@foreach($discuss->comments as $comment)
			<div class="list-group-item response">
				<div class="response-picture"><img src="{{ $comment->user->picture_sm }}"></div>
				<div><a href=""><strong>{{ $comment->user->fullname }}</strong></a></div>
				<p>{{ $comment->content }}</p>
			</div>
			@endforeach
		</ul>
		<div class="reply panel-footer">
			<div class="response-picture"><img src="{{ $lms['profile']->picture_sm }}"></div>
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
@empty
	<h1>Diskusi masih kosong. Mulai diskusi?</h1>
@endforelse
<div class="text-right"> 
	{{ $classroom->paginate_discussions->links() }}
</div>