
<div class="cpost-entry panel panel-default">
	<div class="cpost-meta panel-heading">
		<figure>
			<img src="{{ $lms['profile']->picture_sm }}">
			<figcaption>
				<a href=""><strong>{{ $lms['profile']->fullname }}</strong></a>
			</figcaption>
		</figure>
		<div class="dropdown">
			<button class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-angle-down"></i>
			</button>
			<ul class="dropdown-menu">
				<li><a href="#">Delete post</a></li>
			</ul>
		</div>
	</div>
	<div class="cpost-content panel-body">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</div>
	<ul class="list-group response-wrapper">
		<div class="list-group-item response">
			<div><a href=""><strong>Nama User</strong></div>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,</p>
		</div>
	</ul>
	<div class="reply panel-footer">
		{!! Form::open() !!}
			<div class="form-group {{ $errors->has('response') ? 'has-error' : '' }}">
				{!! Form::text('response', null, ['class' => 'form-control', 'placeholder' => 'Balas...']) !!}
				{!! $errors->first('response', '<p class="help-block">:message</p>') !!}
			</div>
			<div class="text-right"> 
				{!! Form::submit('Balas', ['class'=>'btn btn-flat btn-success']) !!}
			</div>
		{!! Form::close() !!}
	</div>
</div>