@extends('user.app')

@section('content')	
	<div class="container libraries">
		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-default profile-menu">
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
				<div class="panel panel-default">
					<header class="panel-heading">
						<h2 class="panel-title">{{ $page_title }}</h2>
					</header>
					<div class="panel-body">
						<a href="{{ route('assignments.create') }}" class="btn btn-success">Buat baru</a>
					</div>
				</div>

				@forelse($assignments as $assignment)
					<div class="panel panel-default">
						<header class="panel-heading">
							<h2 class="panel-title">{{ $assignment->title }}</h2>
						</header>
						<ul class="list-group">
							<li class="list-group-item">{{ $assignment->content }}</li>
							@if($assignment->file)
								<li class="list-group-item">{{ $assignment->file }}</li>
							@endif
						</ul>
						<div class="panel-footer text-right">
							<a href="{{ route('assignments.edit', $assignment->id) }}" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Edit</a>
							<button class="btn btn-primary btn-sm"><i class="fa fa-share-alt"></i> Bagikan</button>
							<button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
						</div>
					</div>
				@empty
					<div class="panel panel-default">
						<div class="panel-body text-center">
							Tidak ada tugas sama sekali. <a href="{{ route('assignments.create') }}" class="btn btn-link">Buat tugas sekarang.</a>
						</div>
					</div>
				@endforelse
			</div>
		</div>
	</div>
@endsection