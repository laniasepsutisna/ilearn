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
						<a href="{{ route('assignments.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tugas Baru</a>
					</header>
					<div class="panel-body">
						@forelse($assignments as $assignment)
							<div class="panel panel-primary panel-sm">
								<header class="panel-heading">
									<h2 class="panel-title text-bold">{{ $assignment->title }}</h2>
								</header>
								<ul class="list-group">
									<li class="list-group-item">{!! $assignment->content !!}</li>
									@if($assignment->file)
										<li class="list-group-item"><i class="fa fa-paperclip"></i> {{ $assignment->file }}</li>
									@endif
								</ul>
								<div class="panel-footer text-right">
									<a href="{{ route('assignments.edit', $assignment->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
									{!! Form::open(['route' => ['assignments.destroy', $assignment->id], 'method' => 'delete', 'class' => 'element-inline']) !!}
										{!! Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-danger btn-sm warning-delete', 'type' => 'submit', 'data-title' => $assignment->title]) !!}
									{!! Form::close() !!}
								</div>
							</div>
						@empty
							<div class="panel panel-default">
								<div class="panel-body text-center">
									Tidak ada tugas sama sekali. <a href="{{ route('assignments.create') }}" class="btn-link">Buat tugas sekarang.</a>
								</div>
							</div>
						@endforelse
					</div>
					<div class="panel-footer">
						<div class="pull-right nomargin-paginator">
							{{ $assignments->links() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection