@extends('user.app')

@section('content')
<div class="container content">
	<div class="row">
		<div class="col-sm-3 col-md-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Pemberitahuan</h2>
				</div>
				<ul class="list-group">
					<li class="list-group-item"><a class="text-small" href="{{ route('home.announcements') }}"><i class="fa fa-volume-up"></i> Pengumuman</a></li>
					<li class="list-group-item"><a class="text-small" href="{{ route('home.assignments') }}"><i class="fa fa-file"></i> Tugas</a></li>
					<li class="list-group-item"><a class="text-small" href="{{ route('home.onlines') }}"><i class="fa fa-circle"></i> Online</a></li>
				</ul>
			</div>
		</div>
		<div class="col-sm-5 col-md-7">
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