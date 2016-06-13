@extends('user.app')

@section('content')
<div class="container content">
	<div class="row">
		<div class="col-sm-8 col-md-9">
			<div class="text-right">
				<a class="btn btn-link btn-sm" href="{{ route('home.index') }}"><i class="fa fa-angle-double-right"></i> Kembali ke Beranda.</a>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title text-bold">Sedang Online</h2>
				</div>
				<ul class="list-group">
					@foreach($users as $user)
						<li class="list-group-item">
							<a class="btn-sm" href="{{ route('home.friend', $user->username) }}"><i class="fa fa-circle" style="color: green;"></i> {{ $user->fullname }}</a>
						</li>
					@endforeach
				</ul>
			</div>
		</div>		
		<div class="col-sm-4 col-md-3 hidden-sm">
			@include( 'user.global.sidebars._sidebar-right' )
		</div>
	</div>
</div>
@endsection