@extends('user.app')

@section('content')
<div class="container content">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="text-right">
				<a class="btn btn-link btn-sm" href="{{ route('home.index') }}"><i class="fa fa-angle-double-right"></i> Kembali ke Beranda.</a>
			</div>
			<div class="entry">
				<div class="page-title">
					<h3>Pengumuman</h3>
				</div>
				@foreach($announcements as $announcement)
				<article class="post">
					<p>
						<strong><i class="fa fa-volume-up"></i> {{ $announcement->title }}</strong>
						<span class="status pull-right alert-{{ $announcement->status }}">{{ $announcement->urgensi }}</span>
					</p>
					<div>{!! $announcement->content !!}</div>
					<div>{{ $announcement->humantime }}</div>
				</article>
				@endforeach
				<footer>
					<div class="pull-right">
						{{ $announcements->links() }}
					</div>
				</footer>
			</div>
		</div>
	</div>
</div>
@endsection