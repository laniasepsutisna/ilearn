@extends('user.app')

@section('content')	
	<div class="container libraries">
		<div class="row">
			<div class="col-md-3">
				<div class="profile-menu panel panel-default">
					<header class="panel-heading">
						<h2 class="panel-title">Perpustakaan</h2>
					</header>
					<div class="panel-body">
						<ul class="nav nav-pills nav-stacked">
							<li class="{{ set_active('assignments.index') }}"><a href="{{ route('assignments.index') }}">Tugas</a></li>
							<li class="{{ set_active('quizes.index') }}"><a href="{{ route('quizes.index') }}">Quiz</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9">			
				<div class="profile-form panel panel-default">
					<header class="panel-heading">
						<h2 class="panel-title">Quiz</h2>
					</header>
					<div class="panel-body">
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection