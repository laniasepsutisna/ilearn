@extends('user.app')

@section('content')

	@include('user.global._picture')

	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="profile-menu widget">
					<ul class="nav nav-pills nav-stacked">
						<li class="{{ set_active('home.profile') }}"><a href="{{ route('home.profile') }}">Profil</a></li>
						<li class="{{ set_active('home.password') }}"><a href="{{ route('home.password') }}">Password</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-9">			
				<div class="entry profile-form">
					@if($user->id === $lms['profile']->id)
						{!! Form::model($user, ['route' => ['auth.update', $user], 'method' =>'patch', 'role' => 'form', 'class' => 'form-horizontal']) !!}
							@include('user.global._form-profile')
				        {!! Form::close() !!}
				    @else
				    	@include('user.global._identity')
				    @endif
				</div>
			</div>
		</div>
	</div>
@endsection