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
					<h2 class="panel-title text-bold">{{ $page_title }}</h2>
				</div>
				<ul class="list-group">
					@foreach($assignments as $assignment)
						<li class="list-group-item">
							<article class="post assignment">
								<p>
									<strong><i class="fa fa-volume-up"></i> {{ $assignment['title'] }}</strong>
								</p>
								<div>{!! $assignment['pivot']['deadline'] !!}</div>
							</article>
						</li>
					@endforeach
				</ul>
				<footer class="panel-footer text-right">
				</footer>
			</div>
		</div>		
		<div class="col-sm-4 col-md-3 hidden-sm">
			@include( 'user.global.sidebars._sidebar-right' )
		</div>
	</div>
</div>
@endsection