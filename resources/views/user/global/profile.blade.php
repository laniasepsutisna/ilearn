@extends('user.app')

@section('content')

	@include('user.global.profiles._picture')

	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="profile-menu panel panel-default">
					<header class="panel-heading">
						<h2 class="panel-title">Pengaturan</h2>
					</header>
					<div class="panel-body">
						<ul class="nav nav-pills nav-stacked">
							<li class="{{ set_active('home.profile') }}"><a href="{{ route('home.profile') }}">Profil</a></li>
							<li class="{{ set_active('home.password') }}"><a href="{{ route('home.password') }}">Password</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9">			
				<div class="profile-form panel panel-default">
					<header class="panel-heading">
						<h2 class="panel-title">Update Profil</h2>
					</header>
					<div class="panel-body">
						@if($lms['profile']->id === $lms['profile']->id)
							{!! Form::model($lms['profile'], ['route' => ['auth.update', $lms['profile']], 'method' =>'put', 'role' => 'form', 'class' => 'form-horizontal']) !!}
								@include('user.global.profiles._form-profile')
							{!! Form::close() !!}
						@else
							@include('user.global.profiles._identity')
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection