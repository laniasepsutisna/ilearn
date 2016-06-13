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
					<h2 class="panel-title text-bold">Pengumuman</h2>
				</div>
				<ul class="list-group">
					@foreach($announcements as $announcement)
					<li class="list-group-item">
						<article class="post announcement">
							<p>
								<strong><i class="fa fa-volume-up"></i> {{ $announcement->title }}</strong>
								<span class="status pull-right alert-{{ $announcement->status }}">{{ $announcement->urgensi }}</span>
							</p>
							<div>{!! $announcement->content !!}</div>
							<div>{{ $announcement->humantime }}</div>
						</article>
					</li>
					@endforeach
				</ul>
				<footer class="text-right">
					{{ $announcements->links() }}
				</footer>
			</div>
		</div>		
		<div class="col-sm-4 col-md-3 hidden-sm">
			@include( 'user.global.sidebars._sidebar-right' )
		</div>
	</div>
</div>
@endsection