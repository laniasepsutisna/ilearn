<div class="cpost entry">
	<div class="cpost-title">
		<h2>Diskusi Kelas</h2>
	</div>
</div>

<div class="cpost-entry entry">
	<div class="cpost-meta">
		<figure>
			<img src="">
		</figure>
		<div class="pull-right">
			<button><i class="fa fa-angle-down"></i></button>
		</div>
	</div>
	<div class="cpost-content">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</div>
	<div class="response-wrapper">
		<div class="response">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit,
		</div>
	</div>
	<div class="reply">
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