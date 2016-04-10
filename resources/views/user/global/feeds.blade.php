@extends('user.content')

@section('subcontent')
<div class="entry">
	<div class="page-title">
		<h3>Feeds</h3>
	</div>
	@foreach($lms['announcements'] as $announcement)
	<article class="post">
		<p><strong><i class="fa fa-volume-up"></i> {{ $announcement->title }}</strong></p>
		<div>{{ $announcement->content }}</div>
	</article>
	@endforeach
	<footer class="text-right">
		<a href="" class="btn btn-link">Lihat Semua</a>
	</footer>
</div>
@endsection