@extends('user.app')

@section('content')	
	<div class="container libraries">
		<div class="row">
			<div class="col-sm-4 col-md-2 hidden-xs">
				@include('user.global.sidebars._sidebar-left')
			</div>
			<div class="col-md-10">			
				<div class="profile-form panel panel-default">
					<header class="panel-heading">
						<h2 class="panel-title text-bold">{{ $page_title }}</h2>
					</header>
					<div class="panel-body">
						{!! Form::open(['route' => 'courses.store', 'files' => true]) !!}
							@include('user.courses._form')
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection