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
						<a href="{{ route('quizzes.create') }}" class="btn btn-success">Quiz Baru</a>
					</header>
					<div class="panel-body">
						@forelse($quizzes as $quiz)
							<div class="panel panel-primary panel-sm">
								<header class="panel-heading">
									<h2 class="panel-title text-bold">{{ $quiz->title }}</h2>
								</header>
								<ul class="list-group">
									<li class="list-group-item"><strong>Tipe: </strong>{!! $quiz->humanizeType !!}</li>
									<li class="list-group-item"><strong>Waktu: </strong>{!! $quiz->time_limit !!} menit.</li>
								</ul>
								<div class="panel-footer text-right">
									<a href="{{ route('quizzes.edit', $quiz->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
									{!! Form::open(['route' => ['quizzes.destroy', $quiz->id], 'method' => 'delete', 'class' => 'element-inline']) !!}
										{!! Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-danger btn-sm warning-delete', 'type' => 'submit', 'data-title' => $quiz->title]) !!}
									{!! Form::close() !!}
								</div>
							</div>
						@empty
							<div class="panel panel-default">
								<div class="panel-body text-center">
									Tidak ada quiz sama sekali. <a href="{{ route('quizzes.create') }}" class="btn-link">Buat quiz baru sekarang.</a>
								</div>
							</div>
						@endforelse
					</div>
					<div class="panel-footer clearfix">
						<div class="pull-right nomargin-paginator">
							{{ $quizzes->links() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection