@extends('user.app')

@section('content')
<div class="profile" style="background: url('{{ $user->cover }}');">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<figure class="profile-pict text-center">
					<img class="img-circle" src="{{ $user->picture_md }}">
					<figcaption>
						<a href="#" id="changePicture" class="btn-change-image"><i class="fa fa-camera"></i></a>
					</figcaption>
				</figure>				
				<h1 class="profile-name text-center">{{ $user->fullname }}</h1>
			</div>
			<div class="col-md-8 col-md-offset-2 text-right change-cover">
				<a href="#" class="btn-change-image">Ganti Cover</a>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">			
			<div class="entry">
				@if($user->id === Auth::user()->id)
					{!! Form::model($user, ['route' => ['home.update', $user], 'method' =>'patch', 'role' => 'form', 'class' => 'form-horizontal']) !!}
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