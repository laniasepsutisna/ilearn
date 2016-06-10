@extends('user.app')

@section('content')	
	<div class="container libraries">
		<div class="row">
			<div class="col-sm-4 col-md-2 hidden-xs">
				@include('user.global.sidebars._sidebar-left')
			</div>
			<div class="col-md-10">
				<div class="panel panel-default">
					<header class="panel-heading">
						<h3 class="panel-title text-bold">Kalender</h3>
					</header>
					<div class="panel-body">
						<div id="calendar"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection